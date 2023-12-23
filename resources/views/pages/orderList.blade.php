@extends('pages.app')
@section('content')
<div class="container orderList">
    <div class="row">
        <h2>Daftar Transaksi</h2>
        @foreach ($transactions as $transaction)
        <div class="card mb-3 mt-3">
            <div class="card-body">
                <div class="row">
                    <p><strong>
                            <span
                                style="display: inline-block; width: auto;">{{$transaction->order->product->store->nama_toko}}
                                |</span>
                            @if ($transaction->status == 'unpaid')
                            <span class="badge text-bg-warning">Belum Dibayar</span>
                            @elseif ($transaction->menunggu_pembatalan == 'menunggu' && $transaction->status == 'paid')
                            <span class="badge text-bg-warning">Pembatalan Menunggu Konfirmasi Penjual</span>
                            @elseif ($transaction->status == 'paid')
                            <span class="badge text-bg-success">Sudah Dibayar</span>
                            @elseif ($transaction->status == 'dibatalkan')
                            <span class="badge text-bg-danger">Pesanan Dibatalkan</span>
                            @elseif ($transaction->status == 'dikirim')
                            <span class="badge text-bg-success">Pesanan Dikirim</span>
                            @elseif ($transaction->status == 'selesai')
                            <span class="badge text-bg-success">Selesai</span>
                            @endif
                        </strong></p>
                    <div class="col-3">
                        @if ($transaction->order->product)
                        <img src="{{ asset('storage/' . $transaction->order->product->photo_produk) }}"
                            alt="Product Image" style="width: 80px; height: 80px;">
                        @endif
                    </div>
                    <div class="col-3">
                        @if ($transaction->order->product)
                        <p>{{$transaction->order->product->title}}</p>
                        <p>{{$transaction->order->quantity}} Barang x Rp {{
                            number_format($transaction->total_tagihan, 0, ',', '.') }}</p>
                        @endif
                    </div>
                    <div class="col-6">
                        @if ($transaction->order->product)
                        <p class="text-end">Total Belanja</p>
                        <p class="text-end">Rp {{number_format($transaction->total_tagihan, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
                @if ($transaction->status == 'unpaid')
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-register btn-sm" href="#" role="button">Bayar Sekarang</a>
                    <div class="dropdown">
                        <button class="btn btn-outline-login btn-sm" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="/order-list/{{$transaction->midtrans_id}}/batalkan-pesanan">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item">Batalkan</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @elseif ($transaction->status == 'paid')
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-register btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop-{{$transaction->midtrans_id}}">Lacak Pesanan</button>
                    <div class="dropdown">
                        <button class="btn btn-outline-login btn-sm" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form method="POST" action="/order-list/{{$transaction->midtrans_id}}/request-batalkan">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="dropdown-item">Batalkan</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @elseif ($transaction->status == 'paid' && $transaction->menunggu_pembatalan == 'menunggu')
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-register btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop-{{$transaction->midtrans_id}}">Lacak Pesanan</button>
                    <div class="dropdown">
                        <button class="btn btn-outline-login btn-sm" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="submit" class="dropdown-item" disabled>Batalkan</button>
                            </li>
                        </ul>
                    </div>
                </div>
                @elseif ($transaction->status == 'dikirim')
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-register btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop-{{$transaction->midtrans_id}}">Lacak
                        Pesanan</button>
                    <form action="/order-list/{{$transaction->midtrans_id}}/selesai" method="post">
                        @csrf
                        @method('put')
                        <button class="btn btn-outline-login btn-sm" type="submit">Pesanan Diterima</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

@foreach ($transactions as $transaction)
<!-- Modal -->
<div class="modal fade" id="staticBackdrop-{{$transaction->midtrans_id}}" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lacak Pesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Status Pesanan: @if ($transaction->status == 'unpaid')
                    <span class="badge text-bg-warning">Belum Dibayar</span>
                    @elseif ($transaction->status == 'paid')
                    <span class="badge text-bg-success">Sudah Dibayar</span>
                    @elseif ($transaction->status == 'dibatalkan')
                    <span class="badge text-bg-danger">Pesanan Dibatalkan</span>
                    @elseif ($transaction->status == 'dikirim')
                    <span class="badge text-bg-success">Pesanan Dikirim</span>
                    @elseif ($transaction->status == 'selesai')
                    <span class="badge text-bg-success">Selesai</span>
                    @elseif ($transaction->status == 'dibatalkan')
                    <span class="badge text-bg-success">Pesanan Dibatalkan</span>
                    @endif
                </p>
                <p>jasa Pengiriman: {{$transaction->jasa_pengiriman}}</p>
                <p>No Resi Pesanan: {{$transaction->resi_pengiriman}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection