<?php

namespace App\Imports;

use App\Models\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CollectionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       return new \App\Models\Collection([
            'user_id' => !empty($row['user_id']) ? $row['user_id'] : 1,

            'name' => $row['name'],

            'description' => $row['description'] ?? null,

            'created_at' => $row['created_at'] ?? now(),

            'updated_at' => now(),
        ]);
    }
}