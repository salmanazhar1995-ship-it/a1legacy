<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_promote_another_user(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->put(route('admin.users.update', $user), [
            'name' => $user->name,
            'email' => $user->email,
            'is_admin' => true,
        ]);

        $response->assertRedirect(route('admin.users.index'))->assertSessionHas('success');
        $this->assertTrue($user->refresh()->is_admin);
    }

    public function test_admin_cannot_remove_own_admin_access(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->from(route('admin.users.edit', $admin))->put(route('admin.users.update', $admin), [
            'name' => $admin->name,
            'email' => $admin->email,
            'is_admin' => false,
        ]);

        $response->assertRedirect(route('admin.users.edit', $admin))->assertSessionHasErrors('is_admin');
        $this->assertTrue($admin->refresh()->is_admin);
    }
}
