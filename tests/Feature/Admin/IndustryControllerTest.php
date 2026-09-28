<?php

namespace Tests\Feature\Admin;

use App\Models\BusinessUseCase;
use App\Models\Industry;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class IndustryControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_create_a_main_industry(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post(route('admin.industries.store'), [
            'name' => 'Insurance',
            'slug' => '',
            'description' => 'Automation for insurance teams.',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $response->assertRedirect(route('admin.industries.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('industries', [
            'name' => 'Insurance',
            'slug' => 'insurance',
            'is_active' => true,
            'sort_order' => 10,
        ]);
    }

    public function test_non_admin_cannot_create_a_main_industry(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.industries.store'), [])->assertForbidden();
        $this->assertDatabaseCount('industries', 0);
    }

    public function test_main_industry_with_sub_industries_cannot_be_deleted(): void
    {
        $admin = User::factory()->admin()->create();
        $industry = Industry::factory()->create();
        BusinessUseCase::query()->create([
            'industry_id' => $industry->getKey(),
            'title' => 'Claims Operations',
            'slug' => 'claims-operations',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.industries.destroy', $industry));

        $response->assertSessionHasErrors('industry');
        $this->assertModelExists($industry);
    }
}
