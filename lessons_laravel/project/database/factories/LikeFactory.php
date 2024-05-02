<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'news_id' => News::factory(),
            'liked_at' => now()->subSeconds(rand(10, 1000)),
        ];
    }

    public function unliked(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'liked_at' => null,
            ];
        });
    }
}
