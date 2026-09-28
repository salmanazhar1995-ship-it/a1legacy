<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_open_the_public_homepage(): void
    {
        $admin = User::factory()->admin()->create();
        Page::factory()->create(['slug' => 'home', 'title' => 'Homepage']);

        $this->actingAs($admin)
            ->get(route('home'))
            ->assertOk()
            ->assertViewIs('pages.home');
    }
}
