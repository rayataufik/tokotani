@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($showAlert)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Profil petani belum lengkap. Harap tambahkan alamat toko.
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
    </div>
    @endif
    <h1 class="mb-3">Dashboard</h1>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Belum Bayar
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Pengiriman Perlu Diproses
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Pengiriman Telah Diproses
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Menunggu Respon Pembatalan
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Penjualan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Rp20,000</td>
                <td>10</td>
                <td>2</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection