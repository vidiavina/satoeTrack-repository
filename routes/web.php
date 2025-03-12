<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.peminjam.app');
});

Route::get('/jurusan', function () {
    return view('layout.peminjam.jurusan'); 
})->name('jurusan');


