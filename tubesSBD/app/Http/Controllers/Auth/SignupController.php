<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class SignupController extends Controller
{
    // 1. Tampilkan form input email (halaman Sign Up)
    public function showEmailForm()
    {
        return view('auth.signup-email');
    }

    // 2. Kirim kode ke email user
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Kode 6 digit

        // Simpan di session
        session([
            'signup_email' => $email,
            'signup_code' => $code,
            'signup_code_sent_at' => now()
        ]);

        // Kirim email
        Mail::raw("Kode verifikasi Dribbble kamu: {$code}\n\nKode ini berlaku 10 menit.", function($message) use ($email) {
            $message->to($email)
                    ->subject('🔐 Kode Verifikasi Dribbble')
                    ->from(config('mail.from.address'), config('mail.from.name'));
        });

        // Redirect ke halaman input kode
        return redirect()->route('signup.verify', ['email' => $email]);
    }

    // 3. Tampilkan form input 6 digit kode
    public function showVerifyForm($email)
    {
        // Cek apakah email sesuai session
        if (session('signup_email') !== $email) {
            return redirect()->route('register')->withErrors(['email' => 'Sesi tidak valid']);
        }
        return view('auth.signup-verify', ['email' => $email]);
    }

    // 4. Verifikasi kode yang diinput user
    public function verifyCode(Request $request, $email)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        // Cek session
        if (session('signup_email') !== $email) {
            return back()->withErrors(['code' => 'Sesi tidak valid']);
        }

        $storedCode = session('signup_code');
        $sentAt = session('signup_code_sent_at');

        // Cek expired (10 menit)
        if ($sentAt && $sentAt->addMinutes(10)->isPast()) {
            session()->forget(['signup_email', 'signup_code', 'signup_code_sent_at']);
            return back()->withErrors(['code' => 'Kode sudah kedaluwarsa. Silakan minta kode baru.']);
        }

        // Cek kode
        if ($request->code !== $storedCode) {
            return back()->withErrors(['code' => 'Kode tidak cocok. Cek email kamu lagi.']);
        }

        // ✅ BERHASIL! Bersihkan session & lanjut
        session()->forget(['signup_email', 'signup_code', 'signup_code_sent_at']);
        
        // TODO: Di sini nanti buat user baru di database
        // \App\Models\User::create(['email' => $email, ...]);

        return redirect()->route('signup.complete', ['email' => $email]);
    }

    // 5. Halaman sukses / lanjut ke setup profil
    public function showComplete($email)
    {
        return view('auth.signup-complete', ['email' => $email]);
    }
}