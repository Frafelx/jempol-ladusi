<?php

use Illuminate\Support\Facades\Route;
// BARIS INI WAJIB ADA AGAR LARAVEL MENGENALI CONTROLLER-NYA
use App\Http\Controllers\DataPenggunaController; 
use App\Http\Controllers\SettingChatController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/data-pengguna', [DataPenggunaController::class, 'index'])->name('data-pengguna');
Route::get('/setting-chat', [SettingChatController::class, 'index'])->name('setting-chat');
Route::post('/setting-chat', [SettingChatController::class, 'update'])->name('setting-chat.update');