<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed', // confirmed berarti harus cocok dgn new_password_confirmation
        ], [
            'name.required' => 'Username tidak boleh kosong.',
            'name.unique' => 'Username ini sudah dipakai, pilih yang lain.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // 1. Update Username
        $user->name = $request->name;

        // 2. Update Password (Jika diisi)
        if ($request->filled('current_password') || $request->filled('new_password')) {
            // Cek apakah password lama benar
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            // Cek apakah kolom password baru diisi
            if (!$request->filled('new_password')) {
                return back()->withErrors(['new_password' => 'Masukkan password baru jika ingin mengganti.']);
            }
            
            // Enkripsi dan simpan password baru
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}