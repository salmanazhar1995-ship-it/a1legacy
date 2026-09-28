<?php

namespace Tests\Feature\Site;

use App\Models\BusinessUseCase;
use App\Models\Industry;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class IndustryExplorerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_homepage_renders_main_sub_and_detail_industry_panels(): void
    {
        $page = Page::factory()->create(['slug' => 'home']);
        PageSection::factory()->for($page)->create([
            'key' => 'business-fit',
            'type' => 'business_showcase',
            'heading' => 'Industries built for your workflow',
        ]);
        $industry = Industry::factory()->create(['name' => 'Insurance', 'sort_order' => 10]);
        BusinessUseCase::query()->create([
            'industry_id' => $industry->getKey(),
            'category' => 'Agencies & Brokerages',
            'title' => 'Claims Operations',
            'slug' => 'claims-operations',
            'description' => 'Automate claims intake and customer updates.',
            'highlights' => ['Claims intake', 'Customer follow-up'],
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Industries built for your workflow')
            ->assertSee('Main Industry')
            ->assertSee('Sub Industry')
            ->assertSee('Search industries...')
            ->assertSee('Search sub industries...')
            ->assertSee('Insurance')
            ->assertSee('Claims Operations')
            ->assertSee('Automate claims intake and customer updates.');
    }

    public function test_homepage_hides_inactive_main_industries(): void
    {
        $page = Page::factory()->create(['slug' => 'home']);
        PageSection::factory()->for($page)->create(['type' => 'business_showcase']);
        $industry = Industry::factory()->create(['name' => 'Hidden Industry', 'is_active' => false]);
        BusinessUseCase::query()->create([
            'industry_id' => $industry->getKey(),
            'title' => 'Hidden Sub Industry',
            'slug' => 'hidden-sub-industry',
            'description' => 'Hidden detail copy.',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Hidden Industry')
            ->assertDontSee('Hidden detail copy.');
    }
}
