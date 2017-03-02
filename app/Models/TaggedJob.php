<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaggedJob extends Model
{
    //
    protected $fillable = [
        'job_id', 'user_id', 'tag'
    ];

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }

    public function scopeJobs($query, $jobId)
    {
        return $query->where('job_id', $jobId);
    }
    public function scopeWatching()
    {
        return $this->where('tag', 0);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
