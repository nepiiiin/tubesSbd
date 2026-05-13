<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'shot_id',
        'user_id',
        'body',
        'created_at',
        'updated_at',
    ];
}