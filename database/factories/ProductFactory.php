<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
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
            'eyebrow' => 'Core Product',
            'badge' => null,
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraphs(2, true),
            'image_url' => null,
            'benefits' => fake()->sentences(4),
            'visual_type' => fake()->randomElement(['voice', 'website', 'conversation', 'crm']),
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
