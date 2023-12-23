@extends('admin.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="mb-3">Dashboard</h1>
    <div class="row">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Transaksi Berhasil
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$successfulTransactions}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Jumlah User
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$totalUsers}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Jumlah Produk
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$totalProducts}}</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Menunggu Respon Penarikan Saldo
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">0</li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="mt-5">

</div>
@endsection