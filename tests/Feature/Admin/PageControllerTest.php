<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_update_page_content_settings(): void
    {
        $admin = User::factory()->admin()->create();
        $page = Page::factory()->create(['slug' => 'home']);

        $response = $this->actingAs($admin)->put(route('admin.pages.update', $page), [
            'title' => 'Updated home', 'slug' => 'home', 'navigation_label' => 'Home', 'template' => 'home',
            'meta_description' => 'Updated description', 'is_published' => true, 'show_in_navigation' => true, 'sort_order' => 2,
        ]);

        $response->assertRedirect(route('admin.pages.edit', $page))->assertSessionHas('success');
        $this->assertDatabaseHas('pages', ['id' => $page->id, 'title' => 'Updated home', 'sort_order' => 2]);
    }

    public function test_non_admin_cannot_update_page(): void
    {
        $user = User::factory()->create();
        $page = Page::factory()->create();

        $this->actingAs($user)->put(route('admin.pages.update', $page), [])->assertForbidden();
    }
}
