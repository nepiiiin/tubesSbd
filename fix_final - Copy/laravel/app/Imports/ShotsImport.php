<?php

namespace App\Imports;

use App\Models\Shot;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShotsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Shot([

            'user_id' => $row['user_id'],

            'title' => $row['title'],

            'description' => $row['description'] ?? null,

            'image_url' => $row['image_url'],

            'created_at' => $row['created_at'] ?? now(),

            'updated_at' => $row['updated_at'] ?? now(),
        ]);
    }
}