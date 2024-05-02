<?php

namespace Database\Seeders;

use App\Enums\PollTypeStatus;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\News;
use App\Models\NewsComment;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

        $usersCount = 15;
        $newsCount = 25;

        $users = User::factory($usersCount)->create();

        for ($i = 0; $i < $newsCount; $i++) {
            $author = $users->random();
            $usersExceptAuthor = $users->where('id', '<>', $author->id);
            $usersToLike = $users->random(rand(1, $usersCount - 1))->pluck('id');

            News::factory()
                ->for($author)
                ->when(
                    rand(0, 1) === 1,
                    fn (Factory $q) => $q->has(
                        Comment::factory(rand(1, $usersCount - 2))
                            ->state(new Sequence(fn () => ['user_id' => $usersExceptAuthor->random()->id]))
                    )->has(
                        Like::factory($usersToLike->count())
                            ->state(new Sequence(fn ($sequence) => ['user_id' => $usersToLike[$sequence->index]]))
                    )
                )
                ->create();
        }
    }
}
