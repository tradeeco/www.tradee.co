<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobAnswer extends Model
{
    //
    public static $rules = [
        'content' => 'required|max:250',
    ];

    public static $messages = [
        'content.required' => 'This field is required'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jobQuestion()
    {
        return $this->belongsTo('App\Models\JobAnswer');
    }
}
