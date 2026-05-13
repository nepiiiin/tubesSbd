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
}