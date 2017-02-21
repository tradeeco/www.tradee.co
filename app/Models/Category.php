<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function userExperiences()
    {
        return $this->hasMany('App\Models\UserExperience');
    }
    public function userJobInterestedLocations()
    {
        return $this->hasMany('App\Models\UserJobInterestedLocation');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($category) { // before delete() method call this
            $category->jobs()->delete();
            $category->userExperiences()->delete();
            $category->userJobInterestedLocations()->delete();
            // do the rest of the cleanup...
        });
    }
}
