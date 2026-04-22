<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUser extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'contact',
        'gender',
        'status',
        'interests',
        'avatar',
        'city',
        'description',
        'user_id',
        'animal_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function animal()
    {
        return $this->belongsTo('App\Models\Animal');
    }
}
