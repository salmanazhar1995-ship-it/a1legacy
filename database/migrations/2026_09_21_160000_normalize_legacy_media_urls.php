<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('section_items')
            ->where('image_url', 'like', '/storage/neutron/%')
            ->orderBy('id')
            ->get(['id', 'image_url'])
            ->each(function (object $item): void {
                DB::table('section_items')
                    ->where('id', $item->id)
                    ->update([
                        'image_url' => preg_replace('#^/storage/neutron/#', '/media/neutron/', (string) $item->image_url),
                    ]);
            });

        DB::table('site_settings')
            ->where('value', 'like', '/storage/neutron/%')
            ->orderBy('id')
            ->get(['id', 'value'])
            ->each(function (object $setting): void {
                DB::table('site_settings')
                    ->where('id', $setting->id)
                    ->update([
                        'value' => preg_replace('#^/storage/neutron/#', '/media/neutron/', (string) $setting->value),
                    ]);
            });
    }

    public function down(): void
    {
        DB::table('section_items')
            ->where('image_url', 'like', '/media/neutron/%')
            ->orderBy('id')
            ->get(['id', 'image_url'])
            ->each(function (object $item): void {
                DB::table('section_items')
                    ->where('id', $item->id)
                    ->update([
                        'image_url' => preg_replace('#^/media/neutron/#', '/storage/neutron/', (string) $item->image_url),
                    ]);
            });

        DB::table('site_settings')
            ->where('value', 'like', '/media/neutron/%')
            ->orderBy('id')
            ->get(['id', 'value'])
            ->each(function (object $setting): void {
                DB::table('site_settings')
                    ->where('id', $setting->id)
                    ->update([
                        'value' => preg_replace('#^/media/neutron/#', '/storage/neutron/', (string) $setting->value),
                    ]);
            });
    }
};
