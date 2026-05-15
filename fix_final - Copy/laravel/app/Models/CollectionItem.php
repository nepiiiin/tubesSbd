<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionItem extends Model
{
    public $timestamps = false;

    protected $table = 'collection_items';

    protected $fillable = [
        'collection_id',
        'shot_id',
        'added_at',
    ];
}