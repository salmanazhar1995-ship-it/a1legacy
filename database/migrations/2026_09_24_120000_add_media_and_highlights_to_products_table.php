<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        if (! Schema::hasColumn('products', 'image_url')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->string('image_url')->nullable()->after('description');
            });
        }

        if (! Schema::hasColumn('products', 'highlights')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->json('highlights')->nullable()->after('benefits');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('products')) {
            return;
        }

        if (Schema::hasColumn('products', 'highlights')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->dropColumn('highlights');
            });
        }

        if (Schema::hasColumn('products', 'image_url')) {
            Schema::table('products', function (Blueprint $table): void {
                $table->dropColumn('image_url');
            });
        }
    }
};
