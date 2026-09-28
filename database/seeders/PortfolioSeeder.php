<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::query()->where('slug', 'portfolio')->first();
        $legacyPage = Page::query()->where('slug', 'project-portfolio')->first();

        if (! $page && $legacyPage) {
            $legacyPage->update([
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'navigation_label' => 'Portfolio',
                'template' => 'portfolio',
                'meta_description' => 'Explore selected AI, website, CRM and automation projects built by A1 Legacy Labs.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 16,
            ]);
            $page = $legacyPage->fresh();
        }

        if ($page && $legacyPage && $legacyPage->getKey() !== $page->getKey()) {
            $legacyPage->update([
                'is_published' => false,
                'show_in_navigation' => false,
            ]);
        }

        if (! $page) {
            $page = Page::query()->create([
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'navigation_label' => 'Portfolio',
                'template' => 'portfolio',
                'meta_description' => 'Explore selected AI, website, CRM and automation projects built by A1 Legacy Labs.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 16,
            ]);
        }

        $page->update([
            'title' => 'Portfolio',
            'navigation_label' => 'Portfolio',
            'template' => 'portfolio',
            'is_published' => true,
            'show_in_navigation' => true,
            'sort_order' => 16,
        ]);

        PageSection::query()->updateOrCreate(
            ['page_id' => $page->id, 'key' => 'hero'],
            [
                'type' => 'hero',
                'eyebrow' => 'A1 Legacy Labs portfolio',
                'heading' => 'Systems built to turn customer intent into action.',
                'body' => 'Explore selected websites, AI reception, CRM and automation projects. Every project detail is managed from the admin panel.',
                'is_enabled' => true,
                'sort_order' => 0,
            ],
        );

        PageSection::query()
            ->where('page_id', $page->id)
            ->where('key', 'projects')
            ->update(['is_enabled' => false]);

        PageSection::query()
            ->whereHas('page', fn ($query) => $query->where('slug', 'about'))
            ->where('key', 'cta')
            ->where('secondary_button_url', '/project-portfolio')
            ->update(['secondary_button_url' => '/portfolio']);

        $projects = [
            [
                'title' => 'AI Reception and Booking',
                'slug' => 'ai-reception-and-booking',
                'eyebrow' => 'A1 Legacy Labs build',
                'category' => 'Voice AI',
                'excerpt' => 'An always-on reception workflow designed to answer enquiries, capture intent and move qualified conversations into the right booking or human handoff.',
                'description' => 'A connected customer-entry system built around voice AI, structured qualification, booking logic and CRM continuity. The project demonstrates how a business can reduce missed opportunities while keeping human ownership available when it matters.',
                'challenge' => 'Customers can arrive outside office hours, repeat information across channels, or abandon the journey when the next step is unclear.',
                'solution' => 'A1 Legacy Labs connected AI reception, qualification rules, booking and CRM updates into one guided workflow with clear escalation paths.',
                'outcome' => 'A reusable operating pattern for faster response, cleaner handoff and better visibility across the customer journey. No unverified metrics are claimed.',
                'image_url' => '/media/neutron/18f8ce72-acaf-4dab-a9d9-67032ed69053.png',
                'highlights' => ['24/7 enquiry handling', 'Booking workflow', 'CRM-connected handoff'],
                'technologies' => ['Voice AI', 'CRM', 'Booking automation', 'Workflow logic'],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Conversion-Focused Service Website',
                'slug' => 'conversion-focused-service-website',
                'eyebrow' => 'A1 Legacy Labs build',
                'category' => 'Web Experience',
                'excerpt' => 'A premium customer-facing website structure connecting service discovery, lead capture, AI conversation and the next operational step.',
                'description' => 'This project focuses on the website as an operating layer rather than a static brochure. Content, calls-to-action and contact paths are structured around clear customer intent and measurable next steps.',
                'challenge' => 'Many service websites look polished but leave visitors unsure what to do next or disconnect lead capture from the team that must act on it.',
                'solution' => 'A modular website experience with clear service architecture, AI touchpoints, lead capture and connected routing into the wider customer workflow.',
                'outcome' => 'A more coherent digital journey that can be managed and expanded as the business adds services, content and automation.',
                'image_url' => '/media/neutron/DL1994s9jmhV3FqskEzgz5AJoRA3640.png',
                'highlights' => ['Premium responsive UI', 'Structured lead capture', 'AI-ready customer journey'],
                'technologies' => ['Laravel', 'Responsive UI', 'Lead capture', 'AI integrations'],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Connected Lead Journey',
                'slug' => 'connected-lead-journey',
                'eyebrow' => 'A1 Legacy Labs build',
                'category' => 'CRM & Automation',
                'excerpt' => 'A connected pipeline that keeps conversations, ownership, appointments, follow-up and next actions visible in one operating flow.',
                'description' => 'The project maps the full lead journey from first contact through qualification, assignment and follow-up so teams can see what happened, who owns the next step and where automation should assist.',
                'challenge' => 'Leads often get lost between inboxes, spreadsheets, calendars and different team members.',
                'solution' => 'A CRM-centered workflow connecting lead source, conversation context, assignment, scheduling and follow-up automation.',
                'outcome' => 'A clearer operating structure for managing opportunities without inventing or overstating business results.',
                'image_url' => '/media/neutron/Gz0sELUgG4vCKp5ArK4mU6Ln8SY0370.png',
                'highlights' => ['Pipeline visibility', 'Automated follow-up', 'Clear ownership'],
                'technologies' => ['CRM', 'Automation', 'Calendars', 'Notifications'],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Conversation AI Support Layer',
                'slug' => 'conversation-ai-support-layer',
                'eyebrow' => 'A1 Legacy Labs build',
                'category' => 'Conversation AI',
                'excerpt' => 'A guided support and enquiry layer that can answer approved questions, capture context and route complex requests to the right human team.',
                'description' => 'A structured conversation layer designed to make customer access simpler while keeping boundaries, escalation and human handoff explicit.',
                'challenge' => 'Customers expect immediate answers, but not every question should be automated and not every request belongs with the same team.',
                'solution' => 'An AI conversation flow with approved knowledge, intent capture, routing logic and escalation paths into the existing business workflow.',
                'outcome' => 'A scalable framework for responsive customer communication while preserving human review where needed.',
                'image_url' => '/media/neutron/67248fae-43c8-4f31-bb9a-ff2a375e63ff.png',
                'highlights' => ['Approved-answer framework', 'Intent routing', 'Human escalation'],
                'technologies' => ['Conversation AI', 'Knowledge layer', 'CRM routing', 'Automation'],
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Portfolio::query()->updateOrCreate(['slug' => $project['slug']], $project);
        }
    }
}
