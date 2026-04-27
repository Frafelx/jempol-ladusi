<?php

use Illuminate\Support\Facades\Route;
// BARIS INI WAJIB ADA AGAR LARAVEL MENGENALI CONTROLLER-NYA
use App\Http\Controllers\DataPenggunaController; 
use App\Http\Controllers\SettingChatController;
use App\Http\Controllers\KanalPengaduanController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/data-pengguna', [DataPenggunaController::class, 'index'])->name('data-pengguna');
Route::get('/setting-chat', [SettingChatController::class, 'index'])->name('setting-chat');
Route::post('/setting-chat', [SettingChatController::class, 'update'])->name('setting-chat.update');
// ... route lain yang sudah ada ...

Route::get('/kanal-pengaduan', [KanalPengaduanController::class, 'index'])->name('kanal-pengaduan');
Route::post('/kanal-pengaduan', [KanalPengaduanController::class, 'store'])->name('kanal-pengaduan.store');
Route::delete('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'destroy'])->name('kanal-pengaduan.destroy');
Route::get('/kanal-pengaduan', [KanalPengaduanController::class, 'index'])->name('kanal-pengaduan');
Route::post('/kanal-pengaduan', [KanalPengaduanController::class, 'store'])->name('kanal-pengaduan.store');
Route::put('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'update'])->name('kanal-pengaduan.update'); // <-- TAMBAHKAN INI
Route::delete('/kanal-pengaduan/{id}', [KanalPengaduanController::class, 'destroy'])->name('kanal-pengaduan.destroy');