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

            return redirect()->intended('/'); 
        }

        return back()->with('error', 'Kombinasi Email atau Password salah.');
    }

        // Memproses logout
    public function logout(Request $request)
    {
        // Menghapus session auth
        Auth::logout();
        
        // Menghapus dan memperbarui token keamanan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan kembali ke halaman login bawa pesan sukses
        return redirect('/login')->with('success', 'Kamu berhasil logout. Sampai jumpa lagi!');
    }
}