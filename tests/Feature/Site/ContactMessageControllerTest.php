<?php

namespace Tests\Feature\Site;

use App\Mail\ContactEnquiryConfirmation;
use App\Mail\ContactEnquiryReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactMessageControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_valid_submission_creates_contact_message_and_emails_admin_and_client(): void
    {
        SiteSetting::factory()->create([
            'key' => 'contact_email',
            'value' => 'inbox@a1legacy.test',
        ]);
        SiteSetting::factory()->create([
            'key' => 'site_name',
            'value' => 'A1 Legacy',
        ]);
        Mail::fake();

        $response = $this->post('/contact', [
            'name' => 'Avery Stone',
            'email' => 'avery@example.com',
            'company' => 'Stone Labs',
            'phone' => '+1 555 0100',
            'message' => 'We would like to automate our finance operations.',
            'website' => '',
        ]);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'avery@example.com',
            'status' => 'new',
        ]);

        $contactMessage = ContactMessage::query()->sole();

        Mail::assertSent(
            ContactEnquiryReceived::class,
            fn (ContactEnquiryReceived $mail): bool => $mail->hasTo('inbox@a1legacy.test')
                && $mail->hasReplyTo('avery@example.com')
                && $mail->contactMessage->is($contactMessage),
        );
        Mail::assertSent(
            ContactEnquiryConfirmation::class,
            fn (ContactEnquiryConfirmation $mail): bool => $mail->hasTo('avery@example.com')
                && $mail->contactMessage->is($contactMessage),
        );
    }

    public function test_invalid_submission_returns_validation_errors_without_creating_message(): void
    {
        Mail::fake();

        $response = $this->from('/contact')->post('/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'message' => 'short',
        ]);

        $response->assertRedirect('/contact')->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('contact_messages', 0);
        Mail::assertNothingSent();
    }
}
