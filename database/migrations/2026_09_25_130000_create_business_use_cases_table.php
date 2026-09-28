<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('business_use_cases')) {
            return;
        }

        Schema::create('business_use_cases', function (Blueprint $table): void {
            $table->id();
            $table->string('category')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->json('highlights')->nullable();
            $table->text('system_note')->nullable();
            $table->string('link_label')->nullable();
            $table->string('link_url', 1000)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order'], 'business_use_cases_public_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_use_cases');
    }
};
