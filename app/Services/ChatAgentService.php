<?php

namespace App\Services;

class ChatAgentService
{
    /** @return array{message: string, available: bool} */
    public function replyTo(string $message): array
    {
        return [
            'message' => 'Thanks for your message. Live AI responses are not configured yet. Please use the contact page if you need help from our team.',
            'available' => false,
        ];
    }
}
