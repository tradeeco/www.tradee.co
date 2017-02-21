<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    //
    public static $rules = [
        'content' => 'required|max:250',
    ];

    public static $messages = [
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jobAnswers()
    {
        return $this->hasMany('App\Models\JobAnswer')->orderBy('created_at', 'DESC');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
