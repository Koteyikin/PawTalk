<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'body',
        'is_approved',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function parent()
    {
        return $this->belongsTo(comments::class);
    }

    public function replies()
    {
        return $this->hasMany(comments::class, 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany(like::class, 'likeable');
    }

}
