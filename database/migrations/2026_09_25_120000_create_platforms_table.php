<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('platforms')) {
            return;
        }

        Schema::create('platforms', function (Blueprint $table): void {
            $table->id();
            $table->string('title', 120);
            $table->text('description')->nullable();
            $table->string('icon', 40)->default('activity');
            $table->string('link_url', 1000)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedTinyInteger('sort_order')->default(1)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};
