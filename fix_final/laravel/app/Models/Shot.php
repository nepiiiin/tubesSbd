<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shot extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_url',
        'created_at',
        'updated_at',
    ];
}