<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
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
            'name' => fake()->unique()->text(50),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(50, 1000),
            'status' => fake()->randomElement(ProductStatus::values()),
            'created_at' => fake()->dateTimeBetween('-5 days', 'now'),
        ];
    }
}
