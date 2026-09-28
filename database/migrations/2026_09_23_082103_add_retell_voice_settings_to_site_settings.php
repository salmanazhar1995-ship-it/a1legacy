<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('site_settings')->insertOrIgnore([
            [
                'key' => 'retell_voice_public_key',
                'label' => 'Voice public key',
                'group' => 'voice agent',
                'type' => 'text',
                'value' => null,
                'sort_order' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'retell_voice_agent_id',
                'label' => 'Voice agent ID',
                'group' => 'voice agent',
                'type' => 'text',
                'value' => null,
                'sort_order' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')
            ->whereIn('key', ['retell_voice_public_key', 'retell_voice_agent_id'])
            ->delete();
    }
};
