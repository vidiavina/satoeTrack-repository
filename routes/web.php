<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('layout.peminjam.app');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
