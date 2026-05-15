<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShotTag extends Model
{
    public $timestamps = false;

    protected $table = 'shot_tags';

    protected $fillable = [
        'shot_id',
        'tag_id',
    ];
}