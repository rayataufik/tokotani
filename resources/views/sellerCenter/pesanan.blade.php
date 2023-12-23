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
        @foreach ($transactions as $transaction)
        <tbody>
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$transaction->order->product->title}}</td>
                <td>Rp. {{ number_format($transaction->total_tagihan, 0, ',', '.') }}</td>
                <td>{{$transaction->order->quantity}}</td>
                <td>
                    @if ($transaction->status == 'unpaid')
                    <span class="badge text-bg-success">Menunggu Pembayaran</span>
                    @elseif ($transaction->menunggu_pembatalan == 'menunggu' && $transaction->status == 'paid')
                    <span class="badge text-bg-warning">Pembatalan Menunggu Konfirmasi Penjual</span>
                    @elseif ($transaction->status == 'paid')
                    <span class="badge text-bg-warning">Sudah Dibayar</span>
                    @elseif ($transaction->status == 'dibatalkan')
                    <span class="badge text-bg-danger">Dibatalkan</span>
                    @elseif ($transaction->status == 'dikirim')
                    <span class="badge text-bg-success">Pesanan Dikirim</span>
                    @elseif ($transaction->status == 'selesai')
                    <span class="badge text-bg-success">Selesai</span>
                    @endif
                </td>
                <td>
                    @if ($transaction->status == 'paid')
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#Modal-{{$transaction->midtrans_id}}"
                        style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                        Kirim Sekarang
                    </button><br>
                    <form action="/seller/pesanan/{{$transaction->midtrans_id}}/update-request-pembatalan"
                        method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-danger"
                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                            Batalkan
                        </button>
                    </form>
                    @elseif ($transaction->status == 'unpaid')
                    <span class="badge text-bg-danger">Menunggu Pembayaran</span>
                    @elseif ($transaction->status == 'dibatalkan')
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    @elseif ($transaction->status == 'dikirim')
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    @elseif ($transaction->status == 'selesai')
                    <i class='bx bx-dots-horizontal-rounded'></i>
                    @endif
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

@foreach ($transactions as $transaction)
<form action="/seller/pesanan/{{$transaction->midtrans_id}}" method="post">
    @csrf
    @method('put')
    <!-- Modal -->
    <div class="modal fade" id="Modal-{{$transaction->midtrans_id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pengiriman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Nama Pembeli: {{$transaction->user->fullname}}</p>
                    <p>Alamat Pembeli : {{$transaction->user->detail_alamat_user}}
                        {{$transaction->user->kecamatan_user}}
                        {{$transaction->user->kabupaten_user}}
                        {{$transaction->user->provinsi_user}} {{$transaction->user->kode_pos_user}}</p>
                    <label>Masukan No Resi</label>
                    <input type="text" class="form-control" id="resi" name="resi_pengiriman">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Kirim Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach

@endsection