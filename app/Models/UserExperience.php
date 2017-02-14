<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExperience extends Model
{
    //
    public static $rules = [
        'category_id' => 'required',
        'length_id' => 'required',
    ];

    public static $messages = [
        'photo_ids.required' => 'The photo field is required'
    ];
}
