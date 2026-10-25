<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\PeralatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('gunung.index');
});

// Tanpa login
Route::get('gunung', [GunungController::class, 'index'])->name('gunung.index');

// Belum Login
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Wajib login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::view('/profile', 'profile')->name('profile');

    Route::resource('gunung', GunungController::class)->except(['index', 'show']);
    Route::resource('peralatan', PeralatanController::class)->except(['show']);
    Route::resource('booking', BookingController::class)->except(['show']);
});