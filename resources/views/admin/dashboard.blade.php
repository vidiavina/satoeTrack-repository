@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-center mt-4">Dashboard</h2>
    <div class="card-container">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">📦</div>
                <h5 class="mt-2">Peminjaman</h5>
            </div>
        </a>
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">✅</div>
                <h5 class="mt-2">Konfirmasi Peminjaman</h5>
            </div>
        </a>
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm p-3">
                <div class="icon">🔄</div>
                <h5 class="mt-2">Pengembalian</h5>
            </div>
        </a>
    </div>
@endsection
