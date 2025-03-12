<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
