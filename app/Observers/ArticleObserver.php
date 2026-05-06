<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        DB::table('site_stats')->increment('articles_count');

        $city = $article->author?->aboutUser?->city;
        if (!$city) {
            return;
        }

        $exists = \App\Models\Article::where('id', '!=', $article->id)
            ->whereHas('author.aboutUser', function ($q) use ($city) {
                $q->where('city', $city);
            })
            ->exists();

        if (!$exists) {
            DB::table('site_stats')->increment('cities_count');
        }
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        DB::table('site_stats')->decrement('cities_count');
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }
}
