<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shot;
// use App\Models\Job;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalShots = Shot::count();
        $totalJobs = 0;
        $shots = Shot::latest()->take(8)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalShots', 'totalJobs', 'shots'));
    }
}