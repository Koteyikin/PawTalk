<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'nickname' => 'testuser',
            'email' => 'test@example.com',
        ]);
        Category::factory()->count(5)->create();
        Article::factory()->count(50)->create();
    }
}
