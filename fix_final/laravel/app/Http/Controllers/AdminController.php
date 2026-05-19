<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shot;
use App\Models\Job; // <-- Nyalakan ini agar model Job bisa dipakai
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalShots = Shot::count();
        $totalJobs = Job::count(); // <-- Ganti dari 0 menjadi hitungan dinamis dari database

        // 1. Ambil 1 ID Shot tertinggi (terakhir di-scrap) untuk tiap user_id
        $adminShotIds = Shot::select(DB::raw('MAX(id) as id'))
            ->groupBy('user_id')
            ->pluck('id');

        // 2. Ambil data lengkap Shot berdasarkan ID unik di atas
        $shots = Shot::with(['user', 'categories']) 
            ->whereIn('id', $adminShotIds)
            ->withCount('likes')
            ->latest('id') 
            ->take(21)      
            ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalShots', 'totalJobs', 'shots'));
    }
}