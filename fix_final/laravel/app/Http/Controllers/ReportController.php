<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk pakai Query Builder

class ReportController extends Controller
{
    public function index()
    {
        // Memanggil View 'view_top_designers' yang tadi dibuat di HeidiSQL
        // Kita urutkan berdasarkan yang total likes-nya paling banyak
        $topDesigners = DB::table('view_top_designers')
                        ->orderBy('total_likes', 'desc')
                        ->orderBy('total_karya', 'desc')
                        ->paginate(10);

        return view('admin.reports.index', compact('topDesigners'));
    }
}