<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'label' => 'Site name', 'group' => 'general', 'type' => 'text', 'value' => 'A1 Legacy Labs'],
            ['key' => 'site_tagline', 'label' => 'Site tagline', 'group' => 'general', 'type' => 'textarea', 'value' => 'AI-powered customer operations, websites, CRM and automation built around real business workflows.'],
            ['key' => 'header_logo', 'label' => 'Header logo', 'group' => 'branding', 'type' => 'image', 'value' => null, 'media_type' => 'image', 'image_alt' => 'A1 Legacy Labs logo'],
            ['key' => 'footer_logo', 'label' => 'Footer logo', 'group' => 'branding', 'type' => 'image', 'value' => null, 'media_type' => 'image', 'image_alt' => 'A1 Legacy Labs logo'],
            ['key' => 'favicon', 'label' => 'Favicon', 'group' => 'branding', 'type' => 'image', 'value' => null, 'media_type' => 'image', 'image_alt' => 'A1 Legacy Labs favicon'],
            ['key' => 'contact_email', 'label' => 'Contact email', 'group' => 'contact', 'type' => 'email', 'value' => 'hello@a1legacylabs.com'],
            ['key' => 'contact_phone', 'label' => 'Contact phone', 'group' => 'contact', 'type' => 'text', 'value' => '+1 (555) 014-2026'],
            ['key' => 'contact_address', 'label' => 'Contact address', 'group' => 'contact', 'type' => 'textarea', 'value' => '548 Market Street, San Francisco, CA'],
            ['key' => 'whatsapp_url', 'label' => 'WhatsApp chat URL', 'group' => 'floating buttons', 'type' => 'url', 'value' => 'https://wa.me/15550142026'],
            ['key' => 'voice_agent_url', 'label' => 'Voice Agent URL', 'group' => 'floating buttons', 'type' => 'text', 'value' => '/contact'],
            ['key' => 'facebook_url', 'label' => 'Facebook URL', 'group' => 'social', 'type' => 'url', 'value' => 'https://www.facebook.com/A1LegacyAI/'],
            ['key' => 'linkedin_url', 'label' => 'LinkedIn URL', 'group' => 'social', 'type' => 'url', 'value' => 'https://www.linkedin.com/company/a1-legacy'],
            ['key' => 'instagram_url', 'label' => 'Instagram URL', 'group' => 'social', 'type' => 'url', 'value' => 'https://www.instagram.com/a1legacylabs/'],
            ['key' => 'threads_url', 'label' => 'Threads URL', 'group' => 'social', 'type' => 'url', 'value' => 'https://www.threads.com/@a1legacylabs'],
            ['key' => 'footer_text', 'label' => 'Footer text', 'group' => 'general', 'type' => 'text', 'value' => '© 2026 A1 Legacy Labs. All rights reserved.'],
            ['key' => 'retell_voice_public_key', 'label' => 'Voice public key', 'group' => 'voice agent', 'type' => 'text', 'value' => null],
            ['key' => 'retell_voice_agent_id', 'label' => 'Voice agent ID', 'group' => 'voice agent', 'type' => 'text', 'value' => null],
            ['key' => 'smtp_enabled', 'label' => 'Enable SMTP', 'group' => 'smtp', 'type' => 'boolean', 'value' => '0'],
            ['key' => 'smtp_host', 'label' => 'SMTP host', 'group' => 'smtp', 'type' => 'text', 'value' => null],
            ['key' => 'smtp_port', 'label' => 'SMTP port', 'group' => 'smtp', 'type' => 'number', 'value' => '587'],
            ['key' => 'smtp_encryption', 'label' => 'Encryption', 'group' => 'smtp', 'type' => 'select', 'value' => 'tls'],
            ['key' => 'smtp_username', 'label' => 'SMTP username', 'group' => 'smtp', 'type' => 'text', 'value' => null],
            ['key' => 'smtp_password', 'label' => 'SMTP password', 'group' => 'smtp', 'type' => 'password', 'value' => null],
            ['key' => 'smtp_from_address', 'label' => 'From email address', 'group' => 'smtp', 'type' => 'email', 'value' => null],
            ['key' => 'smtp_from_name', 'label' => 'From name', 'group' => 'smtp', 'type' => 'text', 'value' => null],
        ];

        foreach ($settings as $sortOrder => $setting) {
            SiteSetting::query()->firstOrCreate(
                ['key' => $setting['key']],
                [...$setting, 'sort_order' => $sortOrder],
            );
        }
    }
}
