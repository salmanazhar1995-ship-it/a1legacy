<?php

namespace Tests\Feature\Admin;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ContactMessageControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_viewing_message_marks_it_as_read(): void
    {
        $admin = User::factory()->admin()->create();
        $message = ContactMessage::factory()->create(['read_at' => null]);

        $response = $this->actingAs($admin)->get(route('admin.messages.show', $message));

        $response->assertSee($message->name);
        $this->assertNotNull($message->refresh()->read_at);
    }

    public function test_admin_can_update_message_status(): void
    {
        $admin = User::factory()->admin()->create();
        $message = ContactMessage::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.messages.update', $message), ['status' => 'resolved']);

        $response->assertRedirect()->assertSessionHas('success');
        $this->assertSame('resolved', $message->refresh()->status);
    }
}
