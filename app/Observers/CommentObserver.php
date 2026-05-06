<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\comments;

class CommentObserver
{
    /**
     * Handle the comments "created" event.
     */
    public function created(comments $comments): void
    {
        if ($comments->parent_id === null) {
            $comments->article()->increment('comments_count');
        }
    }

    /**
     * Handle the comments "updated" event.
     */
    public function updated(comments $comments): void
    {
        //
    }

    /**
     * Handle the comments "deleted" event.
     */
    public function deleted(comments $comments): void
    {
        Article::where('id', $comments->article_id)->decrement('comments_count');
    }


    /**
     * Handle the comments "restored" event.
     */
    public function restored(comments $comments): void
    {
        //
    }

    /**
     * Handle the comments "force deleted" event.
     */
    public function forceDeleted(comments $comments): void
    {
        //
    }
}
