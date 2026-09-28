<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PageSectionControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_update_page_section(): void
    {
        $admin = User::factory()->admin()->create();
        $page = Page::factory()->create();
        $section = PageSection::factory()->for($page)->create();

        $response = $this->actingAs($admin)->put(route('admin.sections.update', [$page, $section]), [
            'type' => 'hero', 'eyebrow' => 'New', 'heading' => 'Updated heading', 'body' => 'Updated copy',
            'is_enabled' => true, 'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.sections.edit', [$page, $section]));
        $this->assertDatabaseHas('page_sections', ['id' => $section->id, 'heading' => 'Updated heading']);
    }

    public function test_section_from_another_page_returns_not_found(): void
    {
        $admin = User::factory()->admin()->create();
        $page = Page::factory()->create();
        $otherSection = PageSection::factory()->create();

        $this->actingAs($admin)->get(route('admin.sections.edit', [$page, $otherSection]))->assertNotFound();
    }
}
