<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\GunungController;
use App\Http\Controllers\PeralatanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('gunung.index');
});

Route::resource('gunung', GunungController::class)->except(['show']);
Route::resource('peralatan', PeralatanController::class)->except(['show']);
Route::resource('booking', BookingController::class)->except(['show']);