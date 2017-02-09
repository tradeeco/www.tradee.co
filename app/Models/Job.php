<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function jobPhotos()
    {
        return $this->hasMany('App\Models\JobPhoto');
    }

    public static $rules = [
        'title' => 'required|string|min:2|max:20',
        'description' => 'required|min:10|max:500',
        'photo_ids' => 'required'
    ];
    public static $messages = [
        'photo_ids.required' => 'The photo field is required'
    ];
}
