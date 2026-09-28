<?php

namespace Tests\Feature\Mail;

use App\Mail\ContactEnquiryConfirmation;
use App\Mail\ContactEnquiryReceived;
use App\Models\ContactMessage;
use Tests\TestCase;

class ContactEnquiryMailTest extends TestCase
{
    public function test_admin_email_contains_complete_enquiry_and_admin_inbox_link(): void
    {
        $contactMessage = ContactMessage::factory()->make([
            'id' => 42,
            'name' => 'Avery Stone',
            'email' => 'avery@example.com',
            'company' => 'Stone Labs',
            'phone' => '+1 555 0100',
            'message' => 'We would like to automate our finance operations.',
        ]);
        $mail = new ContactEnquiryReceived($contactMessage, 'A1 Legacy');

        $mail->assertSeeInHtml('A new message from Avery Stone');
        $mail->assertSeeInHtml('avery@example.com');
        $mail->assertSeeInHtml('Stone Labs');
        $mail->assertSeeInHtml('+1 555 0100');
        $mail->assertSeeInHtml('We would like to automate our finance operations.');
        $mail->assertSeeInHtml(route('admin.messages.show', $contactMessage));
        $mail->assertSeeInText('Open in Admin Inbox');
    }

    public function test_client_email_confirms_the_message_and_next_step(): void
    {
        $contactMessage = ContactMessage::factory()->make([
            'id' => 42,
            'name' => 'Avery Stone',
            'email' => 'avery@example.com',
            'message' => 'We would like to automate our finance operations.',
        ]);
        $mail = new ContactEnquiryConfirmation($contactMessage, 'A1 Legacy');

        $mail->assertSeeInHtml('Thanks for reaching out, Avery Stone');
        $mail->assertSeeInHtml('Thank you for contacting A1 Legacy.');
        $mail->assertSeeInHtml('We would like to automate our finance operations.');
        $mail->assertSeeInHtml('What happens next?');
        $mail->assertSeeInText('We will reply to avery@example.com.');
    }

    public function test_html_emails_escape_client_provided_content(): void
    {
        $unsafeValue = '<script>alert("xss")</script>';
        $contactMessage = ContactMessage::factory()->make([
            'id' => 42,
            'name' => $unsafeValue,
            'email' => 'avery@example.com',
            'company' => $unsafeValue,
            'phone' => $unsafeValue,
            'message' => $unsafeValue,
        ]);

        $adminHtml = (new ContactEnquiryReceived($contactMessage, 'A1 Legacy'))->render();
        $clientHtml = (new ContactEnquiryConfirmation($contactMessage, 'A1 Legacy'))->render();

        $this->assertStringContainsString('&lt;script&gt;', $adminHtml);
        $this->assertStringNotContainsString($unsafeValue, $adminHtml);
        $this->assertStringContainsString('&lt;script&gt;', $clientHtml);
        $this->assertStringNotContainsString($unsafeValue, $clientHtml);
    }
}
