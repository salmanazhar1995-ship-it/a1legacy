<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pages')) {
            return;
        }

        $now = now();
        $industryPage = DB::table('pages')->where('slug', 'industries')->first();

        if (! $industryPage) {
            $industryPageId = DB::table('pages')->insertGetId([
                'title' => 'Industries',
                'slug' => 'industries',
                'navigation_label' => 'Industries',
                'template' => 'standard',
                'meta_description' => 'Explore how A1 Legacy applies AI, CRM and automation across industries including insurance, real estate, home services and professional services.',
                'is_published' => true,
                'show_in_navigation' => true,
                'sort_order' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $industryPageId = $industryPage->id;
            DB::table('pages')->where('id', $industryPageId)->update([
                'navigation_label' => $industryPage->navigation_label ?: 'Industries',
                'is_published' => true,
                'show_in_navigation' => true,
                'updated_at' => $now,
            ]);
        }

        // Refresh the existing Contact page copy so upgraded installations use the
        // new consultation positioning without requiring a manual database seed.
        $contactPage = DB::table('pages')->where('slug', 'contact')->first();
        if ($contactPage) {
            DB::table('pages')->where('id', $contactPage->id)->update([
                'meta_description' => 'Request an AI and automation consultation with A1 Legacy for voice AI, CRM, websites, lead handling and business automation.',
                'updated_at' => $now,
            ]);
        }

        if (Schema::hasTable('page_sections')) {
            if ($contactPage) {
                DB::table('page_sections')
                    ->where('page_id', $contactPage->id)
                    ->where('key', 'hero')
                    ->update([
                        'eyebrow' => 'AI & automation consultation',
                        'heading' => 'Build a smarter AI-powered business.',
                        'body' => 'Tell us where your business is today and what you want to automate. We’ll review your requirements and identify the right AI, CRM and automation approach.',
                        'updated_at' => $now,
                    ]);

                DB::table('page_sections')
                    ->where('page_id', $contactPage->id)
                    ->where('key', 'contact-form')
                    ->update([
                        'type' => 'contact',
                        'heading' => 'AI & Automation Consultation',
                        'body' => 'Complete this short form so our team can understand your business, current systems and automation priorities.',
                        'is_enabled' => true,
                        'updated_at' => $now,
                    ]);
            }

            $hero = DB::table('page_sections')->where('page_id', $industryPageId)->where('key', 'hero')->first();
            if (! $hero) {
                DB::table('page_sections')->insert([
                    'page_id' => $industryPageId,
                    'key' => 'hero',
                    'type' => 'hero',
                    'eyebrow' => 'Industries',
                    'heading' => 'AI systems designed around how your industry actually works.',
                    'body' => 'Explore practical customer operations, lead handling and automation opportunities by industry. Each page shows where AI can help while keeping the right human handoffs in place.',
                    'is_enabled' => true,
                    'sort_order' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $home = DB::table('pages')->where('slug', 'home')->first();
            if ($home) {
                $existing = DB::table('page_sections')->where('page_id', $home->id)->where('key', 'business-fit')->first();
                $payload = [
                    'type' => 'business_showcase',
                    'eyebrow' => 'Industries',
                    'heading' => 'See where AI fits in your industry',
                    'body' => 'Choose an industry to explore practical customer operations, lead handling and automation opportunities, then open the full industry page for more detail.',
                    'is_enabled' => true,
                    'updated_at' => $now,
                ];

                if ($existing) {
                    DB::table('page_sections')->where('id', $existing->id)->update($payload);
                } else {
                    DB::table('page_sections')->insert($payload + [
                        'page_id' => $home->id,
                        'key' => 'business-fit',
                        'sort_order' => 3,
                        'created_at' => $now,
                    ]);
                }

                DB::table('page_sections')
                    ->where('page_id', $home->id)
                    ->where('key', '!=', 'business-fit')
                    ->whereRaw('LOWER(heading) = ?', ['see exactly where ai fits'])
                    ->update(['is_enabled' => false, 'updated_at' => $now]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pages')) {
            $page = DB::table('pages')->where('slug', 'industries')->first();
            if ($page) {
                DB::table('pages')->where('id', $page->id)->delete();
            }
        }
    }
};
