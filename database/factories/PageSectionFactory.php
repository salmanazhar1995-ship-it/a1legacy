<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PageSection>
 */
class PageSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'key' => fake()->unique()->slug(2),
            'type' => 'feature_grid',
            'eyebrow' => fake()->words(2, true),
            'heading' => fake()->sentence(5),
            'body' => fake()->paragraph(),
            'settings' => [],
            'is_enabled' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
