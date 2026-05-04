<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'age',
        'picture',
        'description',
        'status_animal_id',
        'view'
    ];

    public function status_animal(): BelongsTo
    {
        return $this->belongsTo(StatusAnimal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
