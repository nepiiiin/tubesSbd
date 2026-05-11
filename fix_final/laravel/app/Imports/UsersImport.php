<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([

            'username' => $row['username'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'password' => $row['password_hash'],
            'avatar_url' => $row['avatar_url'] ?? null,
            'bio' => $row['bio'] ?? null,
            'location' => $row['location'] ?? null,
            'website' => $row['website'] ?? null,
            'role' => $row['role'] ?? 'user',
            'created_at' => $row['created_at'] ?? now(),
            'updated_at' => $row['updated_at'] ?? now(),
        ]);
    }
}