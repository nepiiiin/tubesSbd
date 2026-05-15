<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'role'      => 'required|in:admin,user',
        ], [
            'username.unique' => 'Username sudah dipakai, cari yang lain ya!',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        // 2. Simpan data ke database
        User::create([
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => bcrypt($request->password), // Password wajib di-hash (enkripsi)
            'role'      => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Hore! Pengguna baru berhasil ditambahkan.');
    }

    // Menampilkan halaman form edit
    public function edit(User $user) 
    {
        return view('admin.users.edit', compact('user'));
    }

    // Memproses perubahan data ke database
    public function update(Request $request, User $user)
    {
        // 1. Validasi inputan
        // Perhatikan ada tambahan pengecualian unique untuk ID user yang sedang diedit
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|in:admin,user',
            'password'  => 'nullable|min:6', // Password boleh kosong kalau nggak mau diganti
        ]);
        // 2. Siapkan data yang mau diupdate
        $data = [
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'role'      => $request->role,
        ];

        // 3. Cek kalau kolom password diisi, berarti dia mau ganti password
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // 4. Update data ke database
        $user->update($data);

        // 5. Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Sip! Data pengguna berhasil diperbarui.');
    }

    // Menghapus data pengguna dari database
    public function destroy(User $user)
    {
        // Eksekusi hapus data
        $user->delete();

        // Kembalikan ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Wushhh! Data pengguna berhasil dihapus selamanya.');
    }
}