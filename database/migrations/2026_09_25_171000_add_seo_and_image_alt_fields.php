<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addSeoFields('pages', false);
        $this->addSeoFields('products');
        $this->addSeoFields('portfolios');
        $this->addSeoFields('galleries');
        $this->addSeoFields('business_use_cases');

        if (Schema::hasTable('blog_posts')) {
            Schema::table('blog_posts', function (Blueprint $table): void {
                if (! Schema::hasColumn('blog_posts', 'seo_title')) {
                    $table->string('seo_title')->nullable()->after('slug');
                }
                if (! Schema::hasColumn('blog_posts', 'meta_keywords')) {
                    $table->text('meta_keywords')->nullable()->after('seo_title');
                }
                if (! Schema::hasColumn('blog_posts', 'meta_description')) {
                    $table->text('meta_description')->nullable()->after('meta_keywords');
                }
                if (! Schema::hasColumn('blog_posts', 'featured_image_alt')) {
                    $table->string('featured_image_alt')->nullable()->after('featured_image');
                }
            });
        }
    }

    public function down(): void
    {
        $this->dropColumns('pages', ['seo_title', 'meta_keywords']);
        $this->dropColumns('products', ['seo_title', 'meta_keywords', 'meta_description', 'image_alt']);
        $this->dropColumns('portfolios', ['seo_title', 'meta_keywords', 'meta_description', 'image_alt']);
        $this->dropColumns('galleries', ['seo_title', 'meta_keywords', 'meta_description', 'image_alt']);
        $this->dropColumns('business_use_cases', ['seo_title', 'meta_keywords', 'meta_description', 'image_alt']);
        $this->dropColumns('blog_posts', ['seo_title', 'meta_keywords', 'meta_description', 'featured_image_alt']);
    }

    private function addSeoFields(string $tableName, bool $withImageAlt = true): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($tableName, $withImageAlt): void {
            if (! Schema::hasColumn($tableName, 'seo_title')) {
                $table->string('seo_title')->nullable();
            }
            if (! Schema::hasColumn($tableName, 'meta_keywords')) {
                $table->text('meta_keywords')->nullable();
            }
            if (! Schema::hasColumn($tableName, 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
            if ($withImageAlt && ! Schema::hasColumn($tableName, 'image_alt')) {
                $table->string('image_alt')->nullable();
            }
        });
    }

    private function dropColumns(string $tableName, array $columns): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        $existing = array_values(array_filter($columns, fn (string $column): bool => Schema::hasColumn($tableName, $column)));
        if ($existing === []) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($existing): void {
            $table->dropColumn($existing);
        });
    }
};
