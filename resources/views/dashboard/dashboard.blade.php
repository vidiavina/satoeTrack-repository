@extends('layout.app')
@section('title', 'Dashboard')
@push('styles_top')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .card img {
        transition: transform 0.3s ease;
    }

    .card:hover img {
        transform: scale(1.1);
    }


    .card-title {
        color: var(--secondary-color);
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
    }

    @media (min-width: 540px) and (max-width: 1199px) {
        section.container .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>
@endpush

@section('content')
<section class="container my-5">
    <h1 class="text-center fw-bold mb-4">Dashboard</h1>
    <div class="row g-4 justify-content-center">
        <div class="col-12 col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none" data-bs-toggle="tooltip" title="Pinjam barang baru">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex-center flex-column">
                        <span class="line"></span>
                        <div class="ms-4">
                            <div class="display-4">
                                <img src="{{ asset('assets/icon/peminjaman.svg') }}" alt="peminjaman">
                            </div>
                            <h4 class="card-title mt-3">Peminjaman</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none" data-bs-toggle="tooltip" title="Konfirmasi barang yang dipinjam">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex-center flex-column">
                        <div class="line"></div>
                        <div class="ms-4">
                            <div class="display-4">
                                <img src="{{ asset('assets/icon/konf-peminjaman.svg') }}" alt="konfirmasi peminjaman">
                            </div>
                            <h4 class="card-title mt-3">Konfirmasi <br> Peminjaman</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none" data-bs-toggle="tooltip" title="Pengembalian barang yang dipinjam">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex-center flex-column">
                        <div class="line"></div>
                        <div class="ms-4">
                            <div class="display-4">
                                <img src="{{ asset('assets/icon/perbaikan.svg') }}" alt="pengembalian">
                                <!-- <img src="{{ asset('assets/icon/pengembalian.svg') }}" alt="pengembalian"> -->
                            </div>
                            <h4 class="card-title mt-3">Pengembalian</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="#" class="text-decoration-none" data-bs-toggle="tooltip" title="Perbaikan barang yang rusak">
                <div class="card text-center shadow-sm h-100">
                    <div class="card-body d-flex-center flex-column">
                        <div class="line"></div>
                        <div class="ms-4">
                            <div class="display-4">
                                <img src="{{ asset('assets/icon/perbaikan.svg') }}" alt="perbaikan">
                            </div>
                            <h4 class="card-title mt-3">Perbaikan</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection
@push('scripts_bottom')

@endpush