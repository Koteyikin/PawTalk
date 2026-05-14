<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\comments;
use App\Models\User;
use App\Observers\ArticleObserver;
use App\Observers\CommentObserver;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        comments::observe(CommentObserver::class);
        User::observe(UserObserver::class);
        Article::observe(ArticleObserver::class);
    }
}
