<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingController;

Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('booking/data', [BookingController::class, 'getData'])->name('booking.data');
    Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('booking/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('booking/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});