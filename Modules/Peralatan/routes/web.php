<?php

use Illuminate\Support\Facades\Route;
use Modules\Peralatan\Http\Controllers\PeralatanController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('peralatan', PeralatanController::class);
});