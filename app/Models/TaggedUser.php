<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaggedUser extends Model
{
    //
    protected $fillable = [
        'tagged_user_id', 'user_id', 'tag'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tagUser()
    {
        return $this->belongsTo('App\User', 'tagged_user_id');
    }
}
