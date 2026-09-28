<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_redirects_to_contact_page(): void
    {
        $response = $this->get('/register');

        $response->assertRedirect('/contact');
    }

    public function test_registration_submissions_are_not_available(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertMethodNotAllowed();
        $this->assertGuest();
    }
}
