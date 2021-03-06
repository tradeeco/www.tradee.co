<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Job extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'description', 'user_id', 'area_suburb_id', 'category_id', 'slug', 'watching', 'interested', 'shortlisted', 'status'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


//    public function scopeCategories($query, $name='')
//    {
//        return $query->where('categories.name', $name);
//    }
//
//    public function scopeLocations($query, $name='')
//    {
//        return $query->where('area_suburbs.name', $name);
//    }



    public function scopeInterest($query)
    {
        return $query->where('interested', true);
    }

    public function scopeShortlist($query)
    {
        return $query->where('shortlisted', true);
    }

    public function taggedJobs()
    {
        return $this->hasMany('App\Models\TaggedJob');
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function jobQuestions()
    {
        return $this->hasMany('App\Models\JobQuestion')->orderBy('created_at', 'DESC');
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
