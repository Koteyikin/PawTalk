<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmarks extends Model
{
    protected $fillable = [
      'user_id',
      'article_id',
    ];
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function article(): belongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
