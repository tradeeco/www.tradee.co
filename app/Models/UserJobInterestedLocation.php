<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJobInterestedLocation extends Model
{
    //
    protected $fillable = ['area_suburb_id', 'user_id', 'category_id'];

    public function areaSuburb()
    {
        return $this->belongsTo('App\Models\AreaSuburb');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
