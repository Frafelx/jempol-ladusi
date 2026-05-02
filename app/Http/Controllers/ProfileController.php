<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'username'      => 'required|string|max:255',
            'password_lama' => 'required|string',
            'password_baru' => 'nullable|string|min:6',
        ], [
            'username.required'      => 'Username wajib diisi.',
            'password_lama.required' => 'Password lama wajib diisi untuk konfirmasi.',
            'password_baru.min'      => 'Password baru minimal 6 karakter.',
        ]);

        // Ambil user dari database secara eksplisit via Model
        $user = User::find(Auth::id());

        if (!$user) {
            return back()->withErrors(['password_lama' => 'User tidak ditemukan.']);
        }

        // Verifikasi password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        // Update kolom name (username)
        $user->name = $request->username;

        // Update password jika diisi
        if ($request->filled('password_baru')) {
            $user->password = Hash::make($request->password_baru);
        }

        $user->save();

        // Re-login agar session tetap valid
        Auth::login($user);

        return back()->with('profile_success', 'Profil berhasil diperbarui.');
    }
}
