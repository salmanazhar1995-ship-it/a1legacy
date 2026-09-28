<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addMediaColumns('products', 'image_url');
        $this->addMediaColumns('business_use_cases', 'image_url');
        $this->addMediaColumns('portfolios', 'image_url');
        $this->addMediaColumns('galleries', 'image_url');

        if (Schema::hasTable('blog_posts')) {
            $needsType = ! Schema::hasColumn('blog_posts', 'featured_media_type');
            $needsAnimation = ! Schema::hasColumn('blog_posts', 'featured_animation_html_url');

            if ($needsType || $needsAnimation) {
                Schema::table('blog_posts', function (Blueprint $table) use ($needsType, $needsAnimation): void {
                    if ($needsType) {
                        $table->string('featured_media_type', 20)->default('image')->after('featured_image');
                    }
                    if ($needsAnimation) {
                        $table->string('featured_animation_html_url', 1000)->nullable()->after('featured_media_type');
                    }
                });
            }
        }
    }

    public function down(): void
    {
        $this->dropMediaColumns('products');
        $this->dropMediaColumns('business_use_cases');
        $this->dropMediaColumns('portfolios');
        $this->dropMediaColumns('galleries');

        if (Schema::hasTable('blog_posts')) {
            $columns = array_values(array_filter([
                Schema::hasColumn('blog_posts', 'featured_animation_html_url') ? 'featured_animation_html_url' : null,
                Schema::hasColumn('blog_posts', 'featured_media_type') ? 'featured_media_type' : null,
            ]));

            if ($columns !== []) {
                Schema::table('blog_posts', fn (Blueprint $table) => $table->dropColumn($columns));
            }
        }
    }

    private function addMediaColumns(string $tableName, string $after): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        $needsType = ! Schema::hasColumn($tableName, 'media_type');
        $needsAnimation = ! Schema::hasColumn($tableName, 'animation_html_url');
        if (! $needsType && ! $needsAnimation) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($after, $needsType, $needsAnimation): void {
            if ($needsType) {
                $table->string('media_type', 20)->default('image')->after($after);
            }
            if ($needsAnimation) {
                $table->string('animation_html_url', 1000)->nullable()->after('media_type');
            }
        });
    }

    private function dropMediaColumns(string $tableName): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        $columns = array_values(array_filter([
            Schema::hasColumn($tableName, 'animation_html_url') ? 'animation_html_url' : null,
            Schema::hasColumn($tableName, 'media_type') ? 'media_type' : null,
        ]));

        if ($columns !== []) {
            Schema::table($tableName, fn (Blueprint $table) => $table->dropColumn($columns));
        }
    }
};
