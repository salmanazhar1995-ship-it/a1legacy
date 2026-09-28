<?php

namespace Tests\Feature\Site;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use App\Models\SiteSetting;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_published_page_renders_database_content(): void
    {
        $page = Page::factory()->create(['slug' => 'home', 'title' => 'Dynamic Neutron']);
        $section = PageSection::factory()->for($page)->create(['type' => 'feature_grid', 'heading' => 'Database powered content']);
        SectionItem::factory()->for($section, 'section')->create([
            'title' => 'Editable feature',
            'image_url' => '/storage/neutron/example.png',
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertViewIs('pages.home')
            ->assertSee('Database powered content')
            ->assertSee('Editable feature')
            ->assertSee('/storage/neutron/example.png', false);
    }

    public function test_homepage_renders_workflow_proof_and_admin_voice_credentials(): void
    {
        config()->set('services.retell.enabled', true);
        Page::factory()->create(['slug' => 'home']);
        SiteSetting::query()->where('key', 'retell_voice_public_key')->update(['value' => 'admin_public_key']);
        SiteSetting::query()->where('key', 'retell_voice_agent_id')->update(['value' => 'admin_agent_id']);

        $this->get('/')
            ->assertSee('See the customer journey move.')
            ->assertSee('id="workflowProof"', false)
            ->assertSee('data-voice-public-key="admin_public_key"', false)
            ->assertSee('data-voice-agent-id="admin_agent_id"', false)
            ->assertDontSee('Powered by A1Legacy');
    }

    public function test_unpublished_page_returns_not_found(): void
    {
        Page::factory()->create(['slug' => 'home', 'is_published' => false]);

        $this->get('/')->assertNotFound();
    }

    public function test_seeded_about_page_renders_editable_content(): void
    {
        $this->seed(PageSeeder::class);

        $this->get('/about')
            ->assertOk()
            ->assertViewIs('site.page')
            ->assertSee('We turn ambitious ideas into systems that perform.')
            ->assertSee('Start with the outcome');
    }

    public function test_seeded_project_portfolio_renders_project_cards(): void
    {
        $this->seed(PageSeeder::class);

        $this->get('/project-portfolio')
            ->assertOk()
            ->assertViewIs('site.page')
            ->assertSee('Selected work built to move businesses forward.')
            ->assertSee('AI Reception and Booking')
            ->assertSee('Automation');
    }

    public function test_branding_images_render_in_the_site_layout(): void
    {
        Page::factory()->create(['slug' => 'about', 'title' => 'About Us']);
        SiteSetting::factory()->create(['key' => 'header_logo', 'value' => '/media/neutron/header.png']);
        SiteSetting::factory()->create(['key' => 'footer_logo', 'value' => '/media/neutron/footer.png']);
        SiteSetting::factory()->create(['key' => 'favicon', 'value' => '/media/neutron/favicon.png']);

        $this->get('/about')
            ->assertOk()
            ->assertSee('<link rel="icon" href="/media/neutron/favicon.png">', false)
            ->assertSee('src="/media/neutron/header.png"', false)
            ->assertSee('src="/media/neutron/footer.png"', false);
    }

    public function test_site_renders_local_agent_controls_without_redirect_links(): void
    {
        Page::factory()->create(['slug' => 'home']);
        SiteSetting::factory()->create(['key' => 'whatsapp_url', 'value' => 'https://wa.me/15550142026']);
        SiteSetting::factory()->create(['key' => 'voice_agent_url', 'value' => '/contact']);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('Get started')
            ->assertDontSee('href="https://wa.me/15550142026"', false)
            ->assertDontSee('href="/contact"', false)
            ->assertSee('aria-label="Open Chat Agent"', false)
            ->assertSee('aria-label="Talk to our Voice Agent"', false);
    }

    public function test_site_does_not_render_unsafe_floating_action_urls(): void
    {
        Page::factory()->create(['slug' => 'home']);
        SiteSetting::factory()->create(['key' => 'whatsapp_url', 'value' => 'javascript:alert(1)']);
        SiteSetting::factory()->create(['key' => 'voice_agent_url', 'value' => '//unsafe.example.com']);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('javascript:alert(1)', false)
            ->assertDontSee('//unsafe.example.com', false)
            ->assertSee('Quick contact options');
    }
}
