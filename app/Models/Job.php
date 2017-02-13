<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    public function scopeCategories($query, $name='')
    {
        return $query->join('categories', 'jobs.category_id', '=', 'categories.id')->where('categories.name', $name);
    }

    public function scopeLocations($query, $name='')
    {
        return $query->join('area_suburbs', 'jobs.area_suburb_id', '=', 'area_suburbs.id')->where('area_suburbs.name', $name);
    }

    public function jobPhotos()
    {
        return $this->hasMany('App\Models\JobPhoto');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function areaSuburb()
    {
        return $this->belongsTo('App\Models\AreaSuburb');
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
