<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('client_stories') || Schema::hasColumn('client_stories', 'content')) {
            return;
        }

        Schema::table('client_stories', function (Blueprint $table): void {
            $table->longText('content')->nullable()->after('approved_quote');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('client_stories') || ! Schema::hasColumn('client_stories', 'content')) {
            return;
        }

        Schema::table('client_stories', function (Blueprint $table): void {
            $table->dropColumn('content');
        });
    }
};
