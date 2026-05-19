<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();

        // 1. Validasi Input sesuai kriteria form kamu
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'bio'      => ['nullable', 'string', 'max:1024'],
            'avatar'   => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:800'], // Maksimal 800KB
        ]);

        // 2. Petakan input form ke kolom database kamu (HeidiSQL)
        $user->full_name = $request->name; // 'name' dari form masuk ke 'full_name' di DB
        $user->location  = $request->location;
        $user->bio       = $request->bio;

        // 3. Proses Upload Foto jika ada file baru yang diunggah
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Buat nama file unik agar tidak bentrok
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Simpan langsung ke folder public/avatars
            $file->move(public_path('avatars'), $filename);
            
            // Simpan alamat URL-nya ke kolom avatar_url di database
            $user->avatar_url = asset('avatars/' . $filename);
        }

        // 4. Simpan perubahan data user
        $user->save();

        // 5. Redirect kembali ke halaman profil pameran karya kamu
        return redirect()->route('user.profile', ['username' => $user->username])
                         ->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}