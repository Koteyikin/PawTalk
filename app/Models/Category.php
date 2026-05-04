<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'icon',
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
