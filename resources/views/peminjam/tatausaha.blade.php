@extends('layout.app')
@section('title', 'Barang')
@push('styles_top')
<style>

</style>
@endpush

@section('content')
<div class="welcome">
    <a href="" class="arrow">
        <i class="bx bx-left-arrow-alt"></i>
    </a>
    <div class="title">
        <h1>List Barang</h1>
        <p>Tata Usaha</p>
    </div>
</div>

<div class="table-responsive text-center">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Merk</th>
                <th>Spesifikasi</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Proyektor</td>
                <td>Sony</td>
                <td>0045</td>
                <td>Elektronik</td>
                <td>Button</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection