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
        <p>Sarana dan Prasarana</p>
    </div>
</div>

<div class="table-responsive text-center">
    <table class="table table-striped table-bordered text-center">
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
                <td>Speaker</td>
                <td>Sony</td>
                <td>aaaa</td>
                <td>Elektronik(?)</td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection