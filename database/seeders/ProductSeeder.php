<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'title' => 'Voice AI Receptionist',
                'slug' => 'voice-ai-receptionist',
                'eyebrow' => '01 / Core Product',
                'badge' => 'Most Popular',
                'short_description' => 'AI for real phone conversations — inbound and outbound.',
                'description' => 'Give every caller a fast, consistent experience with an AI receptionist trained around your business rules. It handles routine conversations automatically and transfers important moments to your team.',
                'benefits' => ['Answer inbound calls 24/7', 'Make approved outbound calls', 'Qualify leads using your rules', 'Book, reschedule and confirm appointments', 'Follow up leads, quotes and no-shows', 'Create summaries and update supported systems', 'Transfer or escalate to your team'],
                'highlights' => ['Inbound Calls', 'Booking', 'Qualification', 'Escalation'],
                'image_url' => null,
                'visual_type' => 'voice',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'AI-Powered Website',
                'slug' => 'ai-powered-website',
                'eyebrow' => '02 / Core Product',
                'badge' => null,
                'short_description' => 'A conversion-focused website connected to AI, booking and your CRM workflow.',
                'description' => 'Turn your website into an active sales and service channel. Visitors get relevant guidance, clear next steps, and a connected path into your booking and CRM systems.',
                'benefits' => ['Smart service and intent routing', 'AI conversation layer on the site', 'Structured lead capture', 'Booking and next-step automation', 'Dynamic calls-to-action', 'CRM-connected lead journeys', 'Analytics-ready conversion paths'],
                'highlights' => ['Smart Website', 'Lead Capture', 'Booking', 'CRM'],
                'image_url' => null,
                'visual_type' => 'website',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Conversation AI',
                'slug' => 'conversation-ai',
                'eyebrow' => '03 / Core Product',
                'badge' => null,
                'short_description' => 'AI conversations across your website chat widget, SMS and email.',
                'description' => 'Keep customer conversations moving across channels without losing context. Conversation AI answers approved questions, captures intent, and routes every lead to the right next step.',
                'benefits' => ['Website chat widget', 'SMS conversations and follow-up', 'Email responses and routing', 'Approved FAQ answers', 'Lead capture and qualification', 'Booking and handoff paths', 'CRM-connected conversation history'],
                'highlights' => ['Web Chat', 'SMS', 'Email', 'Follow-Up'],
                'image_url' => null,
                'visual_type' => 'conversation',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'A1LegacyStudio CRM',
                'slug' => 'a1legacystudio-crm',
                'eyebrow' => '04 / Core Product',
                'badge' => null,
                'short_description' => 'The A1 Legacy operating layer for businesses that need a CRM foundation behind the AI.',
                'description' => 'Bring leads, appointments, conversations, and automated follow-up into one operating layer. Your team gets a clear view of every opportunity and the actions required to move it forward.',
                'benefits' => ['Lead and opportunity pipelines', 'Calendars and appointment management', 'Unified conversations', 'Workflow automation', 'Lead status and task logic', 'Campaign and follow-up support', 'Reporting and visibility'],
                'highlights' => ['Pipelines', 'Calendars', 'Automation', 'Reporting'],
                'image_url' => null,
                'visual_type' => 'crm',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($products as $product) {
            $record = Product::query()->firstOrCreate(['slug' => $product['slug']], $product);

            // Existing installations already have these products. Populate the
            // new home-card highlights only when the administrator has not set
            // them yet, without overwriting any other edited product content.
            if (blank($record->highlights) && ! empty($product['highlights'])) {
                $record->update(['highlights' => $product['highlights']]);
            }
        }
    }
}
