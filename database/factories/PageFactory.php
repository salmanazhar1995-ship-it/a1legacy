<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => str($title)->title(),
            'slug' => str($title)->slug(),
            'navigation_label' => str($title)->title(),
            'template' => 'standard',
            'meta_description' => fake()->sentence(),
            'is_published' => true,
            'show_in_navigation' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
