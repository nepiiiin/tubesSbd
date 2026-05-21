<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\jobs;

class Job extends Model
{
    protected $fillable = [
        'poster_id',
        'title',
        'company_name',
        'location',
        'job_type',
        'description',
        'apply_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function poster()
   {
    return $this->belongsTo(User::class, 'poster_id');
   }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function getApplicationsCountAttribute()
    {
        return $this->applications()->count();
    }

    public function show(Job $job)
{
    $job->load('poster');

    return view('jobs.show', compact('job'));
}
}