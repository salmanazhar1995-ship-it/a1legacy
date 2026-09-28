<?php

namespace Tests\Feature\Admin;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class SectionItemControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_admin_can_add_item_to_section(): void
    {
        $admin = User::factory()->admin()->create();
        $page = Page::factory()->create();
        $section = PageSection::factory()->for($page)->create();

        $response = $this->actingAs($admin)->post(route('admin.items.store', [$page, $section]), [
            'title' => 'New card', 'description' => 'Card description', 'is_enabled' => true, 'sort_order' => 3,
        ]);

        $response->assertRedirect(route('admin.sections.edit', [$page, $section]));
        $this->assertDatabaseHas('section_items', ['page_section_id' => $section->id, 'title' => 'New card']);
    }

    public function test_admin_can_delete_section_item(): void
    {
        $admin = User::factory()->admin()->create();
        $page = Page::factory()->create();
        $section = PageSection::factory()->for($page)->create();
        $item = SectionItem::factory()->for($section, 'section')->create();

        $response = $this->actingAs($admin)->delete(route('admin.items.destroy', [$page, $section, $item]));

        $response->assertRedirect(route('admin.sections.edit', [$page, $section]));
        $this->assertModelMissing($item);
    }
}
