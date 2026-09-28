<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('products')) {
            if (! Schema::hasColumn('products', 'image_url')) {
                Schema::table('products', fn (Blueprint $t) => $t->string('image_url')->nullable()->after('description'));
            }
            if (! Schema::hasColumn('products', 'highlights')) {
                Schema::table('products', fn (Blueprint $t) => $t->json('highlights')->nullable()->after('benefits'));
            }
        }
        if (! Schema::hasTable('galleries')) {
            Schema::create('galleries', function (Blueprint $t) {
                $t->id();
                $t->string('title');
                $t->string('slug')->unique();
                $t->string('eyebrow')->nullable();
                $t->string('category')->nullable();
                $t->string('client')->nullable();
                $t->date('project_date')->nullable();
                $t->text('excerpt');
                $t->longText('description')->nullable();
                $t->string('image_url')->nullable();
                $t->json('tags')->nullable();
                $t->boolean('is_featured')->default(false);
                $t->boolean('is_active')->default(true);
                $t->unsignedInteger('sort_order')->default(0);
                $t->timestamps();
                $t->index(['is_active', 'is_featured', 'sort_order']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
