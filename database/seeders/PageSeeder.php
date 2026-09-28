<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedPage(
            [
                'title' => 'A1 Legacy Labs',
                'slug' => 'home',
                'navigation_label' => 'Home',
                'template' => 'home',
                'meta_description' => 'A1 Legacy Labs is the autonomous execution layer for modern finance.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 0,
            ],
            [
                [
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'Autonomous finance infrastructure',
                    'heading' => 'Execution without the operational drag.',
                    'body' => 'A1 Legacy Labs connects financial data, decisions, and workflows in one intelligent control layer—so your team can move faster with confidence.',
                    'button_label' => 'Start building',
                    'button_url' => '/contact',
                    'secondary_button_label' => 'Explore features',
                    'secondary_button_url' => '#features',
                ],
                [
                    'key' => 'trusted-by',
                    'type' => 'logo_strip',
                    'eyebrow' => 'Trusted by modern operators',
                    'items' => [
                        ['title' => 'Syntra'], ['title' => 'Klyro'], ['title' => 'Orvix'], ['title' => 'Strivon'], ['title' => 'Lumara'],
                    ],
                ],
                [
                    'key' => 'metrics',
                    'type' => 'stats',
                    'heading' => 'Built for measurable execution',
                    'items' => [
                        ['title' => 'Workflows automated', 'value' => '84%'],
                        ['title' => 'Decisions processed', 'value' => '2.4M+'],
                        ['title' => 'Platform uptime', 'value' => '99.99%'],
                        ['title' => 'Hours saved monthly', 'value' => '12K'],
                    ],
                ],
                [
                    'key' => 'business-fit',
                    'type' => 'business_showcase',
                    'eyebrow' => 'Industries',
                    'heading' => 'See where AI fits in your industry',
                    'body' => 'Choose an industry to explore practical customer operations, lead handling and automation opportunities, then open the full industry page for more detail.',
                ],
                [
                    'key' => 'features',
                    'type' => 'feature_grid',
                    'eyebrow' => 'Platform',
                    'heading' => 'One execution layer. Every critical workflow.',
                    'body' => 'Replace fragmented tools and manual handoffs with a system that observes, decides, and acts.',
                    'items' => [
                        ['title' => 'Unified data graph', 'subtitle' => '01 / Connect', 'description' => 'Bring transactions, models, policies, and operational context into a shared source of truth.'],
                        ['title' => 'Autonomous workflows', 'subtitle' => '02 / Execute', 'description' => 'Turn repeatable financial operations into governed automations with human review where it matters.'],
                        ['title' => 'Continuous controls', 'subtitle' => '03 / Govern', 'description' => 'Apply policy, permissions, and auditability to every decision and downstream action.'],
                        ['title' => 'Live intelligence', 'subtitle' => '04 / Improve', 'description' => 'See performance, exceptions, and opportunities as your operation changes in real time.'],
                    ],
                ],
                [
                    'key' => 'use-cases',
                    'type' => 'feature_grid',
                    'eyebrow' => 'Use cases',
                    'heading' => 'Designed around the work your team actually does.',
                    'items' => [
                        ['title' => 'Treasury operations', 'description' => 'Automate cash positioning, forecasting, transfers, and exception handling across accounts.'],
                        ['title' => 'Financial close', 'description' => 'Coordinate reconciliations, evidence, approvals, and reporting from a single operating layer.'],
                        ['title' => 'Risk and compliance', 'description' => 'Monitor controls continuously and route emerging risk to the right owner before it compounds.'],
                    ],
                ],
                [
                    'key' => 'client-stories',
                    'type' => 'client_stories',
                    'eyebrow' => 'Real client proof',
                    'heading' => 'Client Stories',
                    'body' => 'Real businesses sharing their experience with A1 Legacy systems. Only approved client videos are published here.',
                    'button_label' => 'View All Client Stories',
                    'button_url' => '/client-stories',
                ],
                [
                    'key' => 'gallery-showcase',
                    'type' => 'gallery_showcase',
                    'eyebrow' => 'Selected work',
                    'heading' => 'Gallery',
                    'body' => 'A visual library of selected A1 Legacy systems, websites, automations, and digital experiences.',
                    'button_label' => 'View Gallery',
                    'button_url' => '/gallery',
                ],
                [
                    'key' => 'testimonials',
                    'type' => 'testimonials',
                    'eyebrow' => 'Customer signal',
                    'heading' => 'Trusted when execution matters.',
                    'items' => [
                        ['title' => 'Maya Chen', 'subtitle' => 'COO, Syntra', 'description' => 'A1 Legacy Labs gave us one place to understand and operate our most critical finance workflows. We move faster without losing control.'],
                        ['title' => 'Elias Romero', 'subtitle' => 'VP Finance, Orvix', 'description' => 'Our team reclaimed days of repetitive work every month while improving the quality of every review.'],
                        ['title' => 'Nora Williams', 'subtitle' => 'Head of Risk, Lumara', 'description' => 'The combination of automation and a complete audit trail changed how confidently we can scale.'],
                    ],
                ],
                [
                    'key' => 'pricing',
                    'type' => 'pricing',
                    'eyebrow' => 'Pricing',
                    'heading' => 'Start focused. Scale without friction.',
                    'items' => [
                        ['title' => 'Launch', 'subtitle' => 'For focused teams', 'value' => '$49', 'badge' => 'Monthly', 'description' => "5 automated workflows\nCore integrations\nEmail support", 'link_label' => 'Contact us', 'link_url' => '/contact'],
                        ['title' => 'Scale', 'subtitle' => 'For growing operations', 'value' => '$149', 'badge' => 'Most popular', 'description' => "Unlimited workflows\nAdvanced controls\nPriority support", 'link_label' => 'Contact us', 'link_url' => '/contact'],
                        ['title' => 'Enterprise', 'subtitle' => 'For complex organizations', 'value' => 'Custom', 'badge' => 'Annual', 'description' => "Custom data architecture\nEnterprise security\nDedicated success team", 'link_label' => 'Talk to us', 'link_url' => '/contact'],
                    ],
                ],
                [
                    'key' => 'faq',
                    'type' => 'faq',
                    'eyebrow' => 'Questions',
                    'heading' => 'Everything you need to know.',
                    'items' => [
                        ['title' => 'How quickly can we get started?', 'description' => 'Most teams connect their first data source and launch an initial workflow in a matter of days.'],
                        ['title' => 'Can workflows require human approval?', 'description' => 'Yes. Every workflow can include approval gates, escalation rules, ownership, and a full audit trail.'],
                        ['title' => 'Does A1 Legacy Labs replace our existing systems?', 'description' => 'A1 Legacy Labs connects and coordinates your existing systems. It becomes the execution layer across them rather than forcing a rip-and-replace.'],
                        ['title' => 'Is there an enterprise plan?', 'description' => 'Yes. Enterprise plans include custom architecture, security reviews, support, and deployment options.'],
                    ],
                ],
                [
                    'key' => 'cta',
                    'type' => 'cta',
                    'eyebrow' => 'Move from insight to execution',
                    'heading' => 'Build a finance operation that runs ahead.',
                    'body' => 'Start with one workflow and expand as your team sees the impact.',
                    'button_label' => 'Contact sales',
                    'button_url' => '/contact',
                    'secondary_button_label' => 'Contact sales',
                    'secondary_button_url' => '/contact',
                ],
            ],
        );

        $this->seedPage(
            [
                'title' => 'Products',
                'slug' => 'products',
                'navigation_label' => 'Products',
                'template' => 'products',
                'meta_description' => 'Explore A1 Legacy AI products for calls, websites, conversations, and customer operations.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 10,
            ],
            [],
        );

        $this->seedPage(
            [
                'title' => 'Industries',
                'slug' => 'industries',
                'navigation_label' => 'Industries',
                'template' => 'standard',
                'meta_description' => 'Explore A1 Legacy AI, CRM and automation solutions by industry.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 12,
            ],
            [
                [
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'Industries',
                    'heading' => 'AI systems shaped around how your industry works.',
                    'body' => 'Explore practical customer operations, lead handling, CRM and automation opportunities for the industries A1 Legacy supports.',
                ],
            ],
        );

        $this->seedPage(
            [
                'title' => 'About Us',
                'slug' => 'about',
                'navigation_label' => 'About',
                'template' => 'standard',
                'meta_description' => 'Learn about our team, values, and approach to building practical AI systems for growing businesses.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 15,
            ],
            [
                [
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'About us',
                    'heading' => 'We turn ambitious ideas into systems that perform.',
                    'body' => 'We combine thoughtful strategy, useful AI, and dependable delivery to help businesses create better customer experiences and stronger operations.',
                ],
                [
                    'key' => 'our-story',
                    'type' => 'rich_text',
                    'eyebrow' => 'Our story',
                    'heading' => 'Built around practical outcomes.',
                    'body' => "We started with a simple belief: technology should make a business easier to run, not harder to understand.\n\nOur team works closely with every client to identify the moments where better systems can save time, improve service, and unlock growth. Then we design and deliver solutions that fit the way the business actually works.",
                ],
                [
                    'key' => 'values',
                    'type' => 'feature_grid',
                    'eyebrow' => 'How we work',
                    'heading' => 'Clear thinking. Reliable execution.',
                    'body' => 'These principles guide every project, partnership, and product decision.',
                    'items' => [
                        ['title' => 'Start with the outcome', 'subtitle' => '01 / Focus', 'description' => 'We define success clearly before choosing tools, platforms, or features.'],
                        ['title' => 'Build for real people', 'subtitle' => '02 / Empathy', 'description' => 'Every experience should feel useful and intuitive for customers and internal teams.'],
                        ['title' => 'Make complexity manageable', 'subtitle' => '03 / Clarity', 'description' => 'We turn complicated workflows into systems that are easier to understand and operate.'],
                        ['title' => 'Stay accountable', 'subtitle' => '04 / Trust', 'description' => 'We communicate directly, measure what matters, and take ownership of the result.'],
                    ],
                ],
                [
                    'key' => 'impact',
                    'type' => 'stats',
                    'heading' => 'A partner for meaningful progress.',
                    'items' => [
                        ['title' => 'Client-first approach', 'value' => '100%'],
                        ['title' => 'Support and monitoring', 'value' => '24/7'],
                        ['title' => 'Ideas to execution', 'value' => '1 team'],
                    ],
                ],
                [
                    'key' => 'cta',
                    'type' => 'cta',
                    'eyebrow' => 'Work with us',
                    'heading' => 'Let’s build something useful together.',
                    'body' => 'Tell us about the challenge you want to solve and we will help you find a practical path forward.',
                    'button_label' => 'Contact us',
                    'button_url' => '/contact',
                    'secondary_button_label' => 'View our work',
                    'secondary_button_url' => '/portfolio',
                ],
            ],
        );

        $this->seedPage(
            [
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'navigation_label' => 'Portfolio',
                'template' => 'portfolio',
                'meta_description' => 'Explore selected AI, website, CRM and automation projects built by A1 Legacy Labs.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 16,
            ],
            [
                [
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'A1 Legacy Labs portfolio',
                    'heading' => 'Systems built to turn customer intent into action.',
                    'body' => 'Explore selected websites, AI reception, CRM and automation projects. Every project detail is managed from the admin panel.',
                ],
                [
                    'key' => 'projects',
                    'type' => 'feature_grid',
                    'eyebrow' => 'Featured projects',
                    'heading' => 'Strategy translated into working systems.',
                    'body' => 'Replace these starter projects with your own work, descriptions, categories, and imagery from Pages & content in the admin panel.',
                    'items' => [
                        ['title' => 'AI Reception and Booking', 'subtitle' => 'Voice AI', 'badge' => 'Automation', 'description' => 'An always-on customer reception flow that answers enquiries, qualifies callers, and books the right appointment.'],
                        ['title' => 'Service Business Website', 'subtitle' => 'Web experience', 'badge' => 'Website', 'description' => 'A conversion-focused website connecting service discovery, lead capture, booking, and follow-up.'],
                        ['title' => 'Connected Lead Journey', 'subtitle' => 'CRM workflow', 'badge' => 'Operations', 'description' => 'A coordinated lead pipeline that keeps conversations, ownership, tasks, and next steps visible.'],
                        ['title' => 'Customer Support Assistant', 'subtitle' => 'Conversation AI', 'badge' => 'AI', 'description' => 'A guided support experience that answers approved questions and routes complex requests to the right person.'],
                    ],
                ],
                [
                    'key' => 'cta',
                    'type' => 'cta',
                    'eyebrow' => 'Your project could be next',
                    'heading' => 'Have a result in mind?',
                    'body' => 'Share what you want to improve and we will map the right combination of strategy, design, and automation.',
                    'button_label' => 'Start a conversation',
                    'button_url' => '/contact',
                ],
            ],
        );

        $this->seedPage(
            [
                'title' => 'Gallery', 'slug' => 'gallery', 'navigation_label' => 'Gallery', 'template' => 'gallery',
                'meta_description' => 'Explore selected A1 Legacy projects, systems, websites and automation work.',
                'is_published' => true, 'show_in_navigation' => true, 'sort_order' => 18,
            ],
            [['key' => 'hero', 'type' => 'hero', 'eyebrow' => 'Selected work', 'heading' => 'Gallery', 'body' => 'Explore selected A1 Legacy systems, websites, automations and connected customer experiences.']],
        );

        $this->seedPage(
            [
                'title' => 'Client Stories', 'slug' => 'client-stories', 'navigation_label' => 'Client Stories', 'template' => 'client-stories',
                'meta_description' => 'Real client videos from businesses using A1 Legacy systems, published with client approval.',
                'is_published' => true, 'show_in_navigation' => true, 'sort_order' => 19,
            ],
            [['key' => 'hero', 'type' => 'hero', 'eyebrow' => 'Real client proof', 'heading' => 'Client Stories', 'body' => 'Real businesses using A1 Legacy systems, shared with client approval. No invented metrics, quotes or outcomes.']],
        );

        $this->seedPage(
            [
                'title' => 'Blog',
                'slug' => 'blog',
                'navigation_label' => 'Blog',
                'template' => 'blog',
                'meta_description' => 'A1 Legacy insights on AI, automation, digital customer experiences, and connected business systems.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 19,
            ],
            [
                [
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'A1 Legacy insights',
                    'heading' => 'Ideas for better AI, automation, and digital operations.',
                    'body' => 'Practical articles on AI reception, customer journeys, websites, CRM workflows, and the systems behind modern service businesses.',
                ],
            ],
        );

        $this->seedPage(
            [
                'title' => 'Contact',
                'slug' => 'contact',
                'navigation_label' => 'Contact',
                'template' => 'contact',
                'meta_description' => 'Request an AI and automation consultation with A1 Legacy for voice AI, CRM, websites, lead handling and business automation.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 20,
            ],
            [
                ['key' => 'hero', 'type' => 'hero', 'eyebrow' => 'AI & automation consultation', 'heading' => 'Build a smarter AI-powered business.', 'body' => 'Tell us where your business is today and what you want to automate. We’ll review your requirements and identify the right AI, CRM and automation approach.'],
                ['key' => 'contact-form', 'type' => 'contact', 'heading' => 'AI & Automation Consultation', 'body' => 'Complete this short form so our team can understand your business, current systems and automation priorities.'],
            ],
        );

        $this->seedPage(
            [
                'title' => 'Changelog', 'slug' => 'changelog', 'navigation_label' => 'Changelog', 'template' => 'standard',
                'meta_description' => 'Product updates from A1 Legacy Labs.', 'is_published' => true, 'show_in_navigation' => false, 'sort_order' => 30,
            ],
            [
                ['key' => 'hero', 'type' => 'hero', 'eyebrow' => 'Product updates', 'heading' => 'What’s new in A1 Legacy Labs.', 'body' => 'New capabilities, improvements, and fixes from the team.'],
                ['key' => 'updates', 'type' => 'changelog', 'items' => [
                    ['title' => 'Workflow control center', 'subtitle' => 'September 2026', 'badge' => 'New', 'description' => 'A redesigned operations view for monitoring runs, approvals, exceptions, and performance in real time.'],
                    ['title' => 'Expanded audit exports', 'subtitle' => 'August 2026', 'badge' => 'Improved', 'description' => 'Export complete decision context and approval history for any workflow.'],
                    ['title' => 'Faster data synchronization', 'subtitle' => 'July 2026', 'badge' => 'Performance', 'description' => 'Incremental sync improvements reduce time-to-action across high-volume data sources.'],
                ]],
            ],
        );

        $this->seedLegalPage('Privacy Policy', 'privacy-policy', 'How A1 Legacy Labs handles and protects information.', "This privacy policy explains how A1 Legacy Labs collects, uses, and protects information when you use our services.\n\nInformation we collect\nWe collect account information, product usage data, and information you choose to provide through forms or support requests.\n\nHow we use information\nWe use information to provide, secure, improve, and support the service, and to communicate important product updates.\n\nYour choices\nYou may request access, correction, or deletion of your personal information by contacting our team.\n\nContact\nQuestions about this policy can be sent through the contact page.", 40);
        $this->seedLegalPage('Terms of Service', 'terms-of-service', 'The terms governing use of A1 Legacy Labs.', "These terms govern access to and use of A1 Legacy Labs services. By using the service, you agree to these terms.\n\nUsing the service\nYou are responsible for your account, authorized users, and lawful use of the service.\n\nService availability\nWe work to provide a reliable service and may make changes needed to improve security, performance, or functionality.\n\nYour content\nYou retain ownership of content you submit and grant us the rights needed to operate the service.\n\nContact\nQuestions about these terms can be sent through the contact page.", 50);
    }

    /**
     * @param  array<string, mixed>  $pageData
     * @param  array<int, array<string, mixed>>  $sections
     */
    private function seedPage(array $pageData, array $sections): void
    {
        $page = Page::query()->firstOrCreate(['slug' => $pageData['slug']], $pageData);

        foreach ($sections as $sectionOrder => $sectionData) {
            $items = Arr::pull($sectionData, 'items', []);
            $section = $page->sections()->firstOrCreate(
                ['key' => $sectionData['key']],
                [...$sectionData, 'sort_order' => $sectionOrder],
            );

            $this->seedItems($section, $items);
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     */
    private function seedItems(PageSection $section, array $items): void
    {
        foreach ($items as $itemOrder => $itemData) {
            $section->items()->firstOrCreate(
                ['title' => $itemData['title']],
                [...$itemData, 'sort_order' => $itemOrder],
            );
        }
    }

    private function seedLegalPage(string $title, string $slug, string $description, string $body, int $sortOrder): void
    {
        $this->seedPage(
            [
                'title' => $title,
                'slug' => $slug,
                'navigation_label' => $title,
                'template' => 'legal',
                'meta_description' => $description,
                'is_published' => true,
                'show_in_navigation' => false,
                'sort_order' => $sortOrder,
            ],
            [
                ['key' => 'hero', 'type' => 'hero', 'eyebrow' => 'Legal', 'heading' => $title, 'body' => $description],
                ['key' => 'content', 'type' => 'rich_text', 'body' => $body],
            ],
        );
    }
}
