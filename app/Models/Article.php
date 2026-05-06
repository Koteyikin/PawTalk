<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'user_id',
        'excerpt',
        'comments_count',
        'body',
        'category_id',
        'image',
        'is_featured',
        'published_at',
        'status',
        'reading_time',
        'views_count',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(comments::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmarks::class);
    }

    public function getLikesCountAttribute(): int
    {
        return $this->likes()->count();
    }

}
