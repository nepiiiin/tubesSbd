<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'job_id',
        'applicant_id',
        'cover_letter',
        'resume_url',
        'status',
        'applied_at',
    ];
}