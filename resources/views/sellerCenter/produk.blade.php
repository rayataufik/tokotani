@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="">Produk</h1>
    @if ($showAlert)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Profil petani belum lengkap. Harap tambahkan alamat toko.
    </div>
    @else
    <div class="mt-3">
        <a class="btn login-btn" href="/seller/produk/baru" role="button">Tambah Produk</a>
    </div>
    @endif

    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                    <img src="{{ asset('storage/' . $product->photo_produk) }}" alt="Product Image"
                        style="width: 50px; height: 50px;">
                </td>
                <td>{{$product->title}}</td>
                <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>{{$product->stok}}</td>
                <td><a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-success"
                        href="/seller/produk/{{$product->slug}}/edit">Edit</a> <br>
                    <a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-danger"
                        href="{{ route('product.delete', $product->slug) }}" data-confirm-delete="true">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection