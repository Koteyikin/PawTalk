<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUser extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'contact',
        'interests',
        'avatar',
        'city',
        'description',
        'status_id',
        'gender_id',
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

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }
}
