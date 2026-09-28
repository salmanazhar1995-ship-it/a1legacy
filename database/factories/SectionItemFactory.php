<?php

namespace Database\Factories;

use App\Models\PageSection;
use App\Models\SectionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SectionItem>
 */
class SectionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_section_id' => PageSection::factory(),
            'title' => fake()->sentence(3),
            'subtitle' => fake()->words(2, true),
            'description' => fake()->paragraph(),
            'settings' => [],
            'is_enabled' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
