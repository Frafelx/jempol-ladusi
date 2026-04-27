@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex items-center justify-between border-l-4 border-l-[#d4af37]">
        <div>
            <h3 class="text-lg font-bold text-[#122340]">Selamat Datang di JEMPOL LADUSI</h3>
            <p class="text-sm text-gray-500 mt-1">Sistem informasi pelayanan, pengaduan, dan survei kepuasan terintegrasi.</p>
        </div>
        <div class="hidden sm:block">
            <span class="bg-[#122340]/10 text-[#122340] text-xs font-bold px-3 py-1 rounded-full">
                Sistem Aktif
            </span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center min-h-[400px]">
        
        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 shadow-inner border border-gray-100">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>

        <h4 class="text-xl font-bold text-gray-700 mb-2">Area Data Masih Kosong</h4>
        <p class="text-gray-500 text-center max-w-md">
            Ruang ini siap digunakan untuk menampilkan ringkasan data kepuasan, grafik layanan, atau tabel pengaduan terbaru.
        </p>

        <button class="mt-8 bg-[#122340] hover:bg-[#0a1426] text-white px-6 py-2.5 rounded-lg font-medium tracking-wide transition-all shadow-md shadow-[#122340]/20 flex items-center gap-2">
            <svg class="w-5 h-5 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Widget Baru
        </button>
        
    </div>
@endsection