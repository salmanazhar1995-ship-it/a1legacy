<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminPassword = (string) config('admin.password');

        if (app()->isProduction() && ($adminPassword === '' || $adminPassword === 'ChangeMe123!')) {
            throw new RuntimeException('Set a strong ADMIN_PASSWORD before running the production database seeder.');
        }

        User::query()->updateOrCreate(
            ['email' => config('admin.email')],
            [
                'name' => config('admin.name'),
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        $this->call([
            SiteSettingSeeder::class,
            BrandingSeeder::class,
            PageSeeder::class,
            PortfolioSeeder::class,
            ProductSeeder::class,
            PlatformSeeder::class,
            BusinessUseCaseSeeder::class,
            BlogPostSeeder::class,
            GallerySeeder::class,
            ClientStorySeeder::class,
            ContentImageSeeder::class,
        ]);
    }
}
