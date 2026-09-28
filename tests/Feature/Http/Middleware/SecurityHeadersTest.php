<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class SecurityHeadersTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_same_origin_microphone_access_is_allowed_for_the_voice_agent(): void
    {
        Page::factory()->create(['slug' => 'home']);

        $this->get(route('home'))
            ->assertOk()
            ->assertHeader('Permissions-Policy', 'camera=(), microphone=(self), geolocation=()');
    }
}
