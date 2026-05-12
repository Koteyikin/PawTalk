<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteStat extends Model
{
    protected $fillable = [
        'users_count',
        'cities_count',
        'articles_count',
        'animal_count'
    ];
}
