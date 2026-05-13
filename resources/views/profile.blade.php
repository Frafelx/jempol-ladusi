@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Profil Pengguna</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola username dan kata sandi akun Administrator Anda.</p>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3">
        <div class="p-1.5 bg-emerald-500 rounded-full text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('profile.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <!-- Bagian Username -->
            <div class="mb-8">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Informasi Dasar</h3>
                
                <div class="mb-5">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bagian Ganti Password -->
            <div class="mb-8">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Ganti Kata Sandi</h3>
                <p class="text-xs text-gray-500 mb-4">*Kosongkan semua kolom sandi di bawah ini jika Anda tidak ingin mengganti kata sandi.</p>

                <div class="mb-5">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Sandi Saat Ini</label>
                    <input type="password" name="current_password" placeholder="Masukkan sandi Anda yang sekarang"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-2">
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Sandi Baru</label>
                        <input type="password" name="new_password" placeholder="Minimal 6 karakter"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm @error('new_password') border-red-500 @enderror">
                        @error('new_password')
                            <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-[13px] font-semibold text-gray-700 mb-1.5">Konfirmasi Sandi Baru</label>
                        <input type="password" name="new_password_confirmation" placeholder="Ketik ulang sandi baru"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all text-sm">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-4 flex justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('dashboard') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm shadow-indigo-600/20 transition-all focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection