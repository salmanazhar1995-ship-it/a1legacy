<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class BrandingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(
            ['key' => 'site_name'],
            ['label' => 'Site name', 'group' => 'general', 'type' => 'text', 'value' => 'A1 Legacy Labs', 'sort_order' => 0],
        );

        SiteSetting::query()->updateOrCreate(
            ['key' => 'footer_text'],
            ['label' => 'Footer text', 'group' => 'general', 'type' => 'text', 'value' => '© 2026 A1 Legacy Labs. All rights reserved.', 'sort_order' => 8],
        );

        $brandingDefaults = [
            'header_logo' => '/media/neutron/5796eb21-834d-4d1e-ad4d-fe8adec91310.png',
            'footer_logo' => '/media/neutron/5796eb21-834d-4d1e-ad4d-fe8adec91310.png',
            'favicon' => '/media/neutron/426782af-7117-4d6e-987c-92891b098159.jpg',
        ];

        foreach ($brandingDefaults as $key => $defaultValue) {
            $setting = SiteSetting::query()->firstOrCreate(
                ['key' => $key],
                [
                    'label' => match ($key) {
                        'header_logo' => 'Header logo',
                        'footer_logo' => 'Footer logo',
                        default => 'Favicon',
                    },
                    'group' => 'branding',
                    'type' => 'image',
                    'value' => $defaultValue,
                    'media_type' => 'image',
                    'image_alt' => match ($key) {
                        'favicon' => 'A1 Legacy Labs favicon',
                        default => 'A1 Legacy Labs logo',
                    },
                    'sort_order' => match ($key) {
                        'header_logo' => 2,
                        'footer_logo' => 3,
                        default => 4,
                    },
                ],
            );

            if (blank($setting->value)) {
                $setting->update([
                    'value' => $defaultValue,
                    'type' => 'image',
                    'group' => 'branding',
                    'media_type' => 'image',
                    'image_alt' => $key === 'favicon' ? 'A1 Legacy Labs favicon' : 'A1 Legacy Labs logo',
                ]);
            }
        }
    }
}
