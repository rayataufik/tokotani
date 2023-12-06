@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="mb-3">Pesanan</h1>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Jumlah Pembelian</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Rp20,000</td>
                <td>2</td>
                <td>Menunggu Pembayaran</td>
                <td>Kirim Sekarang <br>
                    Batalkan</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection