@extends('layout.app')
@section('title', 'Barang')
@push('styles_top')
<style>

</style>
@endpush

@section('content')
<div class="container">
    <div class="cards">
        <div class="row d-flex justify-content-start">
            <div class="col-md-6 d-flex">
                <a href="{{ route('jurusan') }}" class="card p-4">
                    <div class="line"></div>
                    <h2 class="text">Jurusan</h2>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('tatausaha') }}" class="card p-4">
                    <div class="line"></div>
                    <h2 class="text">Tata<br>Usaha</h2>
                </a>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-5">
                <a href="{{ route('sarpras') }}" class="card p-4">
                    <div class="line"></div>
                    <h2 class="text">Sarpras</h2>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection