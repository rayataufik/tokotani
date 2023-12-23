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
                    <li class="list-group-item">{{$unpaidCount}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Pengiriman Perlu Diproses
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$paidCount}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Pengiriman Telah Diproses
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$dikirimCount}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Menunggu Respon Pembatalan
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$respon_pembatalan}}</li>
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
        @foreach ($products as $product)
        <tbody>
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $product->title }}</td>
                <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>{{ $product->stok }}</td>
                <td>{{ $transactionsSelesaiCounts[$product->id] ?? 0 }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection