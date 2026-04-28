<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\SettingChatController;
use App\Http\Controllers\KanalPengaduanController;
use App\Http\Controllers\BukuTeleponController; // Gabungkan semua use di sini

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/data-pengguna', [DataPenggunaController::class, 'index'])->name('data-pengguna');

// Bagian Setting Chat & Kanal Pengaduan
Route::get('/setting-chat', [SettingChatController::class, 'index'])->name('setting-chat');
Route::post('/setting-chat', [SettingChatController::class, 'update'])->name('setting-chat.update');

Route::get('/kanal-pengaduan', [KanalPengaduanController::class, 'index'])->name('kanal-pengaduan');
Route::post('/kanal-pengaduan', [KanalPengaduanController::class, 'store'])->name('kanal-pengaduan.store');
Route::put('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'update'])->name('kanal-pengaduan.update');
Route::delete('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'destroy'])->name('kanal-pengaduan.destroy');

// Bagian Buku Telepon
Route::get('/buku-telepon', [BukuTeleponController::class, 'index'])->name('buku-telepon.index');
Route::delete('/buku-telepon/{id}', [BukuTeleponController::class, 'destroy'])->name('buku-telepon.destroy');
