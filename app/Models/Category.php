<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;
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
