<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function loginProses(Request $request)
    {
        // 1. Validasi inputan form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Cek kecocokan data di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // 3. Kalau cocok, cek role-nya. Kalau admin, lempar ke dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } 
            
            // Kalau user biasa, lempar ke halaman utama (home)
            return redirect()->intended('/'); 
        }

        // 4. Kalau email/password salah, tendang balik ke halaman login bawa pesan error
        return back()->with('error', 'Email atau Password salah, coba ingat-ingat lagi!');
    }
}