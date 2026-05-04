<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $fillable = [
        'status'
    ];

    public function aboutUser(): HasMany
    {
        return $this->hasMany(AboutUser::class);
    }
}
