<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD ADMIN
    Route::get('/kelola-admin', [AdminController::class, 'index'])->name('kelola-admin');
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

Route::get('/get-admin/{id}', [AdminController::class, 'edit'])->name('edit-admin');