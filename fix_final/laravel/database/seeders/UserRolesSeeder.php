<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::where('email', 'employer@test.com')->update(['role' => 'employer']);
        \App\Models\User::where('email', 'admin@test.com')->update(['role' => 'admin']);
    }
}
