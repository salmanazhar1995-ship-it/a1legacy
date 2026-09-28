<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class ClientStorySeeder extends Seeder
{
    public function run(): void
    {
        // No fake clients, metrics, quotes or videos are seeded.
        $home = Page::query()->where('slug', 'home')->first();
        $legacy = $home?->sections()->where('key', 'testimonials')->first();
        if ($legacy) {
            $starterNames = ['Maya Chen', 'Elias Romero', 'Nora Williams'];
            $hasStarterDemo = $legacy->items()->whereIn('title', $starterNames)->exists();
            if ($hasStarterDemo) {
                $legacy->update(['is_enabled' => false]);
            }
        }
    }
}
