<?php

namespace App\Imports;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApplicationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $jobExists = Job::where('id', $row['job_id'])->exists();

        $applicantExists = User::where('id', $row['applicant_id'])->exists();

        if (!$jobExists || !$applicantExists) {
            return null;
        }

        return new Application([

            'job_id' => $row['job_id'],

            'applicant_id' => $row['applicant_id'],

            'cover_letter' => $row['cover_letter'] ?? null,

            'resume_url' => $row['resume_url'] ?? null,

            'status' => $row['status'] ?? null,

            'applied_at' => $row['applied_at'] ?? now(),
        ]);
    }
}