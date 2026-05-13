<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'question',
        'answer',
        'answered_at',
        'answered_by',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }
}
