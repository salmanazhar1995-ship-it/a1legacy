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
        $now = now();

        DB::table('site_settings')->insertOrIgnore([
            ['key' => 'smtp_enabled', 'label' => 'Enable SMTP', 'group' => 'smtp', 'type' => 'boolean', 'value' => '0', 'sort_order' => 16, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_host', 'label' => 'SMTP host', 'group' => 'smtp', 'type' => 'text', 'value' => null, 'sort_order' => 17, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_port', 'label' => 'SMTP port', 'group' => 'smtp', 'type' => 'number', 'value' => '587', 'sort_order' => 18, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_encryption', 'label' => 'Encryption', 'group' => 'smtp', 'type' => 'select', 'value' => 'tls', 'sort_order' => 19, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_username', 'label' => 'SMTP username', 'group' => 'smtp', 'type' => 'text', 'value' => null, 'sort_order' => 20, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_password', 'label' => 'SMTP password', 'group' => 'smtp', 'type' => 'password', 'value' => null, 'sort_order' => 21, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_from_address', 'label' => 'From email address', 'group' => 'smtp', 'type' => 'email', 'value' => null, 'sort_order' => 22, 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'smtp_from_name', 'label' => 'From name', 'group' => 'smtp', 'type' => 'text', 'value' => null, 'sort_order' => 23, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('site_settings')
            ->whereIn('key', [
                'smtp_enabled',
                'smtp_host',
                'smtp_port',
                'smtp_encryption',
                'smtp_username',
                'smtp_password',
                'smtp_from_address',
                'smtp_from_name',
            ])
            ->delete();
    }
};
