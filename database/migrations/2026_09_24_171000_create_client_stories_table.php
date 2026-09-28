<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('client_stories')) {
            return;
        } Schema::create('client_stories', function (Blueprint $t) {
            $t->id();
            $t->string('person_name');
            $t->string('business_name');
            $t->string('role')->nullable();
            $t->string('implementation_label')->nullable();
            $t->text('approved_quote')->nullable();
            $t->string('video_url')->nullable();
            $t->string('poster_image_url')->nullable();
            $t->boolean('is_featured')->default(false);
            $t->boolean('is_active')->default(false);
            $t->boolean('is_approved_for_public_use')->default(false);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
            $t->index(['is_active', 'is_approved_for_public_use', 'is_featured', 'sort_order'], 'client_stories_public_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_stories');
    }
};
