<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(rand(2, 5), true),
            'content' => fake()->paragraphs(rand(1, 5), true),
            'banner' => fake()->imageUrl(),
            'is_published' => fake()->boolean(),
            'created_at' => now()->subSeconds(rand(10, 1000)),
        ];
    }
}
