<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamController;

Route::middleware('guest:web,admin,peminjam')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    // Add other guest-only routes here
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin,peminjam'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); // Ensure this route exists
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth:admin'])->group(function () {
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