<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShotCategory extends Model
{
    public $timestamps = false;

    protected $table = 'shot_categories';

    protected $fillable = [
        'shot_id',
        'category_id',
    ];
}