<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->sentence(6),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),

            'excerpt' => fake()->paragraph(),
            'body' => fake()->text(1000),

            'image' => fake()->imageUrl(800, 600, 'articles'),

            'is_featured' => fake()->boolean(20), // 20% featured
            'status' => fake()->randomElement(['draft', 'published']),

            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),

            'reading_time' => fake()->numberBetween(3, 15),
            'views_count' => fake()->numberBetween(0, 1000),
        ];
    }
}
