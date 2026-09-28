<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            [
                'title' => 'Live AI Activity',
                'description' => 'Calls, conversations and automation activity visible in one customer journey.',
                'icon' => 'activity',
                'sort_order' => 1,
            ],
            [
                'title' => 'Workflow Automation',
                'description' => 'Lead handling, reminders, routing and follow-up move automatically.',
                'icon' => 'automation',
                'sort_order' => 2,
            ],
            [
                'title' => 'APIs & Integrations',
                'description' => 'Connect supported CRMs and tools through APIs, webhooks or middleware.',
                'icon' => 'integrations',
                'sort_order' => 3,
            ],
            [
                'title' => 'A1LegacyStudio CRM',
                'description' => 'Use our CRM layer when you need pipelines, calendars, automation and reporting.',
                'icon' => 'crm',
                'sort_order' => 4,
            ],
        ];

        if (Platform::query()->doesntExist()) {
            foreach ($platforms as $data) {
                Platform::query()->create([...$data, 'is_active' => true]);
            }
        }

        // Preserve old CMS content but hide the superseded generic platform block.
        $home = Page::query()->where('slug', 'home')->first();
        if ($home) {
            $home->sections()
                ->where(function ($query): void {
                    $query->whereRaw('LOWER(heading) LIKE ?', ['%everything connected%'])
                        ->orWhereIn('key', ['platform', 'platforms', 'platform-overview', 'platform-features']);
                })
                ->update(['is_enabled' => false]);
        }
    }
}
