<?php

use Illuminate\Support\Facades\Route;
// BARIS INI WAJIB ADA AGAR LARAVEL MENGENALI CONTROLLER-NYA
use App\Http\Controllers\DataPenggunaController; 

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/data-pengguna', [DataPenggunaController::class, 'index'])->name('data-pengguna');