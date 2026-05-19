<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    // 🔗 RELATIONS
    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    // Helper: hitung jumlah pelamar
    public function getApplicationsCountAttribute()
    {
        return $this->applications()->count();
    }
}