<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD ADMIN
    Route::get('/kelola-admin', [AdminController::class, 'index'])->name('kelola-admin');
    Route::post('/kelola-admin', [AdminController::class, 'store'])->name('simpan-admin');
    Route::put('/kelola-admin/update/{id}', [AdminController::class, 'update'])->name('update-admin');
    Route::post('/kelola-admin/hapus/{id}', [AdminController::class, 'destroy']);
    Route::delete('/kelola-admin/hapus/{id}', [AdminController::class, 'destroy'])->name('hapus-admin');
    
    // CRUD PEMINJAM
    Route::get('/kelola-peminjam', [PeminjamController::class, 'index'])->name('kelola-peminjam');
    Route::post('/kelola-peminjam', [PeminjamController::class, 'store'])->name('simpan-peminjam');
    Route::put('/kelola-peminjam/update/{id}', [PeminjamController::class, 'update'])->name('update-peminjam');
    Route::post('/kelola-peminjam/hapus/{id}', [PeminjamController::class, 'destroy']);
    Route::delete('/kelola-peminjam/hapus/{id}', [PeminjamController::class, 'destroy'])->name('hapus-peminjam');
    Route::post('/importing-peminjam', [PeminjamController::class, 'importExcel'])->name('import-excel-peminjam');
    Route::get('/importing-peminjam/{kode_import}', [PeminjamController::class, 'previewExcel'])->name('preview-excel-peminjam');
    Route::post('/importings-peminjam', [PeminjamController::class, 'simpanExcel'])->name('simpan-excel-peminjam');
});

// FETCH JSON VIA AJAX
Route::get('/get-admin/{id}', [AdminController::class, 'edit'])->name('edit-admin');
Route::get('/get-peminjam/{id}', [PeminjamController::class, 'edit'])->name('edit-peminjam');
Route::post('/status-peminjam', [PeminjamController::class, 'updateStatus'])->name('update-status-peminjam');

Route::get('/jurusan', function () {
    return view('layout.peminjam.jurusan'); 
})->name('jurusan');

Route::get('/tatausaha', function () {
    return view('layout.peminjam.tatausaha'); 
})->name('tatausaha');

Route::get('/sarpras', function () {
    return view('layout.peminjam.sarpras'); 
})->name('sarpras');