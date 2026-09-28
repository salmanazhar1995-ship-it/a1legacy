<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $socials = [
            [
                'key' => 'facebook_url',
                'label' => 'Facebook URL',
                'group' => 'social',
                'type' => 'url',
                'value' => 'https://www.facebook.com/A1LegacyAI/',
                'sort_order' => 110,
            ],
            [
                'key' => 'linkedin_url',
                'label' => 'LinkedIn URL',
                'group' => 'social',
                'type' => 'url',
                'value' => 'https://www.linkedin.com/company/a1-legacy',
                'sort_order' => 111,
            ],
            [
                'key' => 'instagram_url',
                'label' => 'Instagram URL',
                'group' => 'social',
                'type' => 'url',
                'value' => 'https://www.instagram.com/a1legacylabs/',
                'sort_order' => 112,
            ],
            [
                'key' => 'threads_url',
                'label' => 'Threads URL',
                'group' => 'social',
                'type' => 'url',
                'value' => 'https://www.threads.com/@a1legacylabs',
                'sort_order' => 113,
            ],
        ];

        foreach ($socials as $social) {
            $existing = DB::table('site_settings')->where('key', $social['key'])->exists();

            if ($existing) {
                DB::table('site_settings')
                    ->where('key', $social['key'])
                    ->update([
                        'label' => $social['label'],
                        'group' => $social['group'],
                        'type' => $social['type'],
                        'value' => $social['value'],
                        'sort_order' => $social['sort_order'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('site_settings')->insert([
                    ...$social,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        DB::table('site_settings')
            ->whereIn('key', ['github_url', 'x_url'])
            ->delete();
    }

    public function down(): void
    {
        DB::table('site_settings')
            ->whereIn('key', ['facebook_url', 'instagram_url', 'threads_url'])
            ->delete();

        DB::table('site_settings')
            ->where('key', 'linkedin_url')
            ->update([
                'label' => 'LinkedIn URL',
                'group' => 'social',
                'type' => 'url',
                'value' => 'https://www.linkedin.com/',
                'updated_at' => now(),
            ]);

        foreach ([
            ['key' => 'github_url', 'label' => 'GitHub URL', 'value' => 'https://github.com/', 'sort_order' => 112],
            ['key' => 'x_url', 'label' => 'X URL', 'value' => 'https://x.com/', 'sort_order' => 113],
        ] as $social) {
            DB::table('site_settings')->insertOrIgnore([
                ...$social,
                'group' => 'social',
                'type' => 'url',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
};
