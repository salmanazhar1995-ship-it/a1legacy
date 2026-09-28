<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table): void {
                if (! Schema::hasColumn('site_settings', 'media_type')) {
                    $table->string('media_type', 20)->nullable()->after('value');
                }
                if (! Schema::hasColumn('site_settings', 'image_alt')) {
                    $table->string('image_alt')->nullable()->after('media_type');
                }
                if (! Schema::hasColumn('site_settings', 'animation_html_url')) {
                    $table->string('animation_html_url', 1000)->nullable()->after('image_alt');
                }
            });
        }

        if (Schema::hasTable('client_stories')) {
            Schema::table('client_stories', function (Blueprint $table): void {
                if (! Schema::hasColumn('client_stories', 'poster_media_type')) {
                    $table->string('poster_media_type', 20)->default('image')->after('poster_image_url');
                }
                if (! Schema::hasColumn('client_stories', 'poster_image_alt')) {
                    $table->string('poster_image_alt')->nullable()->after('poster_media_type');
                }
                if (! Schema::hasColumn('client_stories', 'poster_animation_html_url')) {
                    $table->string('poster_animation_html_url', 1000)->nullable()->after('poster_image_alt');
                }
            });
        }

        // Preserve legacy image media and give existing uploads sensible editable ALT defaults.
        if (Schema::hasTable('site_settings') && Schema::hasColumn('site_settings', 'media_type')) {
            DB::table('site_settings')
                ->where(function ($query): void {
                    $query->where('type', 'image')->orWhere('group', 'media');
                })
                ->whereNull('media_type')
                ->update(['media_type' => 'image']);

            DB::table('site_settings')
                ->whereNotNull('value')
                ->where('value', '<>', '')
                ->where(function ($query): void {
                    $query->whereNull('image_alt')->orWhere('image_alt', '');
                })
                ->orderBy('id')
                ->get(['id', 'label', 'key'])
                ->each(function (object $setting): void {
                    $fallbackAlt = trim((string) ($setting->label ?: str_replace('_', ' ', (string) $setting->key)));
                    DB::table('site_settings')->where('id', $setting->id)->update([
                        'image_alt' => $fallbackAlt !== '' ? $fallbackAlt : 'Website image',
                    ]);
                });
        }

        if (Schema::hasTable('client_stories') && Schema::hasColumn('client_stories', 'poster_image_alt')) {
            DB::table('client_stories')
                ->whereNotNull('poster_image_url')
                ->where('poster_image_url', '<>', '')
                ->where(function ($query): void {
                    $query->whereNull('poster_image_alt')->orWhere('poster_image_alt', '');
                })
                ->orderBy('id')
                ->get(['id', 'person_name', 'business_name'])
                ->each(function (object $story): void {
                    $name = trim((string) ($story->person_name ?? ''));
                    $business = trim((string) ($story->business_name ?? ''));
                    $fallbackAlt = trim($name.($name !== '' && $business !== '' ? ' - ' : '').$business.' client story');
                    DB::table('client_stories')->where('id', $story->id)->update([
                        'poster_image_alt' => $fallbackAlt !== '' ? $fallbackAlt : 'Client story video poster',
                    ]);
                });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('site_settings')) {
            Schema::table('site_settings', function (Blueprint $table): void {
                $columns = array_values(array_filter([
                    Schema::hasColumn('site_settings', 'animation_html_url') ? 'animation_html_url' : null,
                    Schema::hasColumn('site_settings', 'image_alt') ? 'image_alt' : null,
                    Schema::hasColumn('site_settings', 'media_type') ? 'media_type' : null,
                ]));
                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }

        if (Schema::hasTable('client_stories')) {
            Schema::table('client_stories', function (Blueprint $table): void {
                $columns = array_values(array_filter([
                    Schema::hasColumn('client_stories', 'poster_animation_html_url') ? 'poster_animation_html_url' : null,
                    Schema::hasColumn('client_stories', 'poster_image_alt') ? 'poster_image_alt' : null,
                    Schema::hasColumn('client_stories', 'poster_media_type') ? 'poster_media_type' : null,
                ]));
                if ($columns !== []) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
