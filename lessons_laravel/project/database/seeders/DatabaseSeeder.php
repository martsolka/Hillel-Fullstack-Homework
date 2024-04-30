<?php

namespace Database\Seeders;

use App\Enums\PollTypeStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('poll_types')->insert([
            [
                'name' => 'How was your 2023 overall?',
                'description' => 'This poll type allows users to share their feedback on the year 2023.',
                'status' => fake()->randomElement(PollTypeStatus::cases())->value,
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Movie Rating',
                'description' => 'This poll type allows users to rate a movie.',
                'status' => PollTypeStatus::DRAFT->value,
                'created_at' => now(),
            ],
            [
                'name' => 'Product Survey',
                'description' => NULL,
                'status' => fake()->randomElement(PollTypeStatus::cases())->value,
                'created_at' => now()->subDays(2),
            ]
        ]);

        $categories = Category::factory(10)->create();
        $tags = Tag::factory(20)->create();

        for ($i = 0; $i < 35; $i++) {
            $randCategory = $categories->random();
            $randTags = $tags->random(rand(3, 10));
            Product::factory()
                ->for($randCategory)
                ->hasAttached($randTags)
                ->create();
        }
    }
}
