@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<section class="pt-4 mt-2">
<h2 class="text-center fw-bold">Dashboard</h2>
<div class="d-flex justify-content-center">
    <div class="card-container row w-100 gap-lg-0 gap-4">
        <a href="#" class="col-lg-4 col-12 text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">📦</div>
                <h4 class="text-center mt-2">Peminjaman</h4>
            </div>
        </a>
        <a href="#" class="col-lg-4 col-12 text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">✅</div>
                <h4 class="text-center mt-2">Konfirmasi Peminjaman</h4>
            </div>
        </a>
        <a href="#" class="col-lg-4 col-12 text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">🔄</div>
                <h4 class="text-center mt-2">Pengembalian</h4>
            </div>
        </a>
    </div>
</div>
</section>
@endsection