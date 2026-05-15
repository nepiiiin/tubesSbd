<?php

namespace App\Imports;

use App\Models\Job;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JobsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $posterExists = User::where('id', $row['poster_id'])->exists();

        if (!$posterExists) {
            return null;
        }

        return new Job([

            'poster_id' => $row['poster_id'],

            'title' => $row['title'],

            'company_name' => $row['company_name'] ?? null,

            'location' => $row['location'] ?? null,

            'job_type' => $row['job_type'] ?? null,

            'description' => $row['description'] ?? null,

            'apply_url' => $row['apply_url'] ?? null,

            'created_at' => $row['created_at'] ?? now(),

            'updated_at' => $row['updated_at'] ?? now(),
        ]);
    }
}