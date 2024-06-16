<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomNumber(2),
            'image' => fake()->imageUrl(),
            'category_id' => fake()->numberBetween(1, 4),
            'stock' => fake()->numberBetween(1, 100),
            'is_available' => fake()->boolean(),
            'is_favorite' => fake()->boolean()
        ];
    }
}