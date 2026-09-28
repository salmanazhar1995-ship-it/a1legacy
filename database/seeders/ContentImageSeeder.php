<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class ContentImageSeeder extends Seeder
{
    public function run(): void
    {
        $siteImages = [
            [
                'key' => 'home_hero_background_image',
                'label' => 'Home hero background image',
                'value' => '/media/neutron/8BZiqiOy4DtdFbKS4qBJHs8m8c65e.png',
                'media_type' => 'image',
                'image_alt' => 'A1 Legacy Labs AI operations background',
                'sort_order' => 90,
            ],
            [
                'key' => 'home_dashboard_image',
                'label' => 'Home dashboard image',
                'value' => '/media/neutron/dRCibrQCVmx2qENBVHdJylXlAVkce8f.png',
                'media_type' => 'image',
                'image_alt' => 'A1 Legacy Labs operations dashboard',
                'sort_order' => 91,
            ],
        ];

        foreach ($siteImages as $siteImage) {
            SiteSetting::query()->firstOrCreate(
                ['key' => $siteImage['key']],
                [...$siteImage, 'group' => 'media', 'type' => 'image'],
            );
        }

        $this->seedPageImages('home', [
            'features' => [
                'Unified data graph' => '/media/neutron/YELxzwaOxsExrGvBT572FFZii2Q0370.png',
                'Autonomous workflows' => '/media/neutron/Gz0sELUgG4vCKp5ArK4mU6Ln8SY0370.png',
                'Continuous controls' => '/media/neutron/63atGZRcFSYAVEJMyOLTiV1A0370.png',
                'Live intelligence' => '/media/neutron/4vW8CaGRqbnNJ3C9x883qYsT40370.png',
            ],
            'use-cases' => [
                'Treasury operations' => '/media/neutron/To5yrQD14FVkySTlmPsrS4Ju07476.png',
                'Financial close' => '/media/neutron/2JvStPYuzyKNf1uuTFXmNC3v9ds7476.jpg',
                'Risk and compliance' => '/media/neutron/I6tFrYwvxBNruea4o4bgTzamFoQ7476.jpg',
            ],
            'testimonials' => [
                'Maya Chen' => '/media/neutron/KM0CyfIFmLy4MawL3kLp4IoDjc75d1.png',
                'Elias Romero' => '/media/neutron/hRq6oXS8ROVwLWQCyIcioL085M9692.png',
                'Nora Williams' => '/media/neutron/RmPopEffsZgxf2V4XyEjJWKUN3c7a49.png',
            ],
        ]);

        $this->seedPageImages('changelog', [
            'updates' => [
                'Workflow control center' => '/media/neutron/DL1994s9jmhV3FqskEzgz5AJoRA3640.png',
                'Expanded audit exports' => '/media/neutron/o0CW2vAQEgLsfpGUaveip0kOSM3640.png',
                'Faster data synchronization' => '/media/neutron/1V8f4PPn5bCeocyXlyy068cBY3640.png',
            ],
        ]);
    }

    /** @param array<string, array<string, string>> $sectionImages */
    private function seedPageImages(string $pageSlug, array $sectionImages): void
    {
        $page = Page::query()->where('slug', $pageSlug)->first();

        if ($page === null) {
            return;
        }

        foreach ($sectionImages as $sectionKey => $itemImages) {
            $section = $page->sections()->where('key', $sectionKey)->first();

            if ($section === null) {
                continue;
            }

            foreach ($itemImages as $itemTitle => $imagePath) {
                $section->items()
                    ->where('title', $itemTitle)
                    ->whereNull('image_url')
                    ->update(['image_url' => $imagePath]);
            }
        }
    }
}
