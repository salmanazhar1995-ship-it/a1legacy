<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_unauthenticated_request_redirects_to_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_non_admin_user_is_forbidden_from_admin_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_admin_can_view_dashboard_metrics(): void
    {
        $admin = User::factory()->admin()->create();
        User::factory()->count(2)->create();
        Page::factory()->create();

        $response = $this->actingAs($admin)->get('/admin');

        $response
            ->assertOk()
            ->assertViewIs('admin.dashboard')
            ->assertViewHas('totalUsers', 3)
            ->assertViewHas('publishedPages', 1);
    }

    public function test_regular_user_can_view_account_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/dashboard')->assertSee('Account ready');
    }
}
