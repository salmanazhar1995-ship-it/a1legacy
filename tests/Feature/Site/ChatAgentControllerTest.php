<?php

namespace Tests\Feature\Site;

use Tests\TestCase;

class ChatAgentControllerTest extends TestCase
{
    public function test_valid_message_returns_the_provider_fallback(): void
    {
        $response = $this->postJson(route('chat-agent.messages.store'), [
            'message' => 'How can your team help automate our support workflow?',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Thanks for your message. Live AI responses are not configured yet. Please use the contact page if you need help from our team.',
                'available' => false,
            ]);
    }

    public function test_empty_message_returns_422_with_a_helpful_error(): void
    {
        $this->postJson(route('chat-agent.messages.store'), ['message' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message'])
            ->assertJsonPath('errors.message.0', 'Please enter a message.');
    }

    public function test_message_longer_than_the_limit_returns_422(): void
    {
        $this->postJson(route('chat-agent.messages.store'), [
            'message' => str_repeat('a', 1001),
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['message'])
            ->assertJsonPath('errors.message.0', 'Messages may not be longer than 1,000 characters.');
    }
}
