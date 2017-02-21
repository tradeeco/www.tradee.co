<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaSuburb extends Model
{
    //
    public function userJobInterestedLocations()
    {
        return $this->hasMany('App\Models\UserJobInterestedLocation');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($area) { // before delete() method call this
            $area->jobs()->delete();
            $area->userJobInterestedLocations()->delete();
            // do the rest of the cleanup...
        });
    }
}
