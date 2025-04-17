<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/jurusan', function () {
    return view('layout.peminjam.jurusan'); 
})->name('jurusan');

Route::get('/tatausaha', function () {
    return view('layout.peminjam.tatausaha'); 
})->name('tatausaha');

Route::get('/sarpras', function () {
    return view('layout.peminjam.sarpras'); 
})->name('sarpras');
