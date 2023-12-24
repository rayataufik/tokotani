@extends('pages.app')
@section('content')
<div class="container discovery">
    @if ($products->isEmpty())
    <div class="alert alert-light" role="alert">
        <h4 class="alert-heading">Produk Tidak Ditemukan</h4>
        <hr>
        <p>Sepertinya tidak ada produk untuk pencarian ini.</p>
    </div>
    @endif
    <div class="row">
        @foreach ($products as $product)
        <div class="col-3 mt-4">
            <div class="card" style="width: 19rem;">
                <img src="{{ asset('storage/' . $product->photo_produk) }}" class="card-img-top" alt="..."
                    style="object-fit: cover; width: 303px; height: 206px;">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{ substr(strip_tags($product->description), 0, 100) }}...</p>
                    <p>Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                    <a href="/produk/{{$product->slug}}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection