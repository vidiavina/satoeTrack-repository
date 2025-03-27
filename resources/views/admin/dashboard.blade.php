@extends('layout.app')
@section('title', 'Dashboard')
@push('styles_top')
<style>
    .card-custom {
        height: 200px;
        max-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: 2px solid #E0E0E0;
    }
</style>
@endpush

@section('content')
    <h2 class="text-center mt-4">Dashboard</h2>
    <div class="card-container">
        <a href="#" class="text-decoration-none">
            <div class="card card-custom shadow-sm p-3">
                <div class="icon">📦</div>
                <h5 class="mt-2">Peminjaman</h5>
            </div>
        </a>
        <a href="#" class="text-decoration-none">
            <div class="card card-custom shadow-sm p-3">
                <div class="icon">✅</div>
                <h5 class="mt-2">Konfirmasi Peminjaman</h5>
            </div>
        </a>
        <a href="#" class="text-decoration-none">
            <div class="card card-custom shadow-sm p-3">
                <div class="icon">🔄</div>
                <h5 class="mt-2">Pengembalian</h5>
            </div>
        </a>
    </div>
@endsection
