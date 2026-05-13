<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\SettingChatController;
use App\Http\Controllers\KanalPengaduanController;
use App\Http\Controllers\BukuTeleponController; 
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK (TIDAK PERLU LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

/*
|--------------------------------------------------------------------------
| RUTE PRIVAT (WAJIB LOGIN)
|--------------------------------------------------------------------------
| Semua rute di dalam grup ini dilindungi oleh middleware 'auth'.
| Pengguna yang belum login akan dilempar otomatis ke halaman login.
*/
Route::middleware(['auth'])->group(function () {
    
    // Autentikasi & Profil Pengguna
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Data Pengguna
    Route::get('/data-pengguna', [DataPenggunaController::class, 'index'])->name('data-pengguna');

    // Menu Setting Chat
    Route::get('/setting-chat', [SettingChatController::class, 'index'])->name('setting-chat');
    Route::post('/setting-chat', [SettingChatController::class, 'update'])->name('setting-chat.update');

    // Menu Kanal Pengaduan
    Route::get('/kanal-pengaduan', [KanalPengaduanController::class, 'index'])->name('kanal-pengaduan');
    Route::post('/kanal-pengaduan', [KanalPengaduanController::class, 'store'])->name('kanal-pengaduan.store');
    Route::put('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'update'])->name('kanal-pengaduan.update');
    Route::delete('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'destroy'])->name('kanal-pengaduan.destroy');

    // Menu Buku Telepon
    Route::get('/buku-telepon', [BukuTeleponController::class, 'index'])->name('buku-telepon.index');
    Route::delete('/buku-telepon/{id}', [BukuTeleponController::class, 'destroy'])->name('buku-telepon.destroy');

    // API Notifikasi (AJAX Real-time)
    Route::get('/api/notifications', [NotificationController::class, 'getLatest'])->name('api.notifications');
    // API Simpan Status Follow Up ke Database
    Route::post('/api/mark-follow-up', [DataPenggunaController::class, 'markFollowUp'])->name('mark-follow-up');
});