<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GunungController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('gunung.index');
});

// Tanpa login: daftar dan detail gunung
Route::get('gunung', [GunungController::class, 'index'])->name('gunung.index');
Route::get('gunung/{gunung}', [GunungController::class, 'show'])
    ->whereNumber('gunung')
    ->name('gunung.show');

// Belum login
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
});

// Khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('gunung', GunungController::class)->except(['index', 'show']);
});