@extends('layout.app')
@section('title', 'Jurusan')
@push('styles_top')
<style>

</style>
@endpush

@section('content')
<div class="container mt-5">
    <!-- Baris Pertama: 3 Card -->
    <div class="row">
        <div class="col-md-4 mb-4 ">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Pengembangan perangkat lunak dan gim</h2>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Teknik komputer jaringan</h2>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Desain Komunikasi Visual</h2>
            </a>
        </div>
    </div>

    <!-- Baris Kedua: 3 Card -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Teknik Kendaraan Ringan</h2>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Teknik Permesinan</h2>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Teknik Pengelasan</h2>
            </a>
        </div>
    </div>

    <!-- Baris Ketiga: 2 Card Ditengah -->
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Busana Butik</h2>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="" class="card p-4">
                <div class="line"></div>
                <h2 class="jurusan">Akuntansi</h2>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts_bottom')
@endpush