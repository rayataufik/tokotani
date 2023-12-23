@extends('pages.app')

@section('content')
<div class="container produk-detail">
    <div class="row">
        <div class="col-4">
            <img src="{{asset('storage/'.$products->photo_produk)}}"
                class="rounded mx-auto d-block float-start img-produk-detail" alt="...">
        </div>
        <div class="col-5 produk-col">
            <div class="nama-produk text-start fw-semibold">
                {{$products->title}}
            </div>
            <div class="produk-terjual">
                Terjual 10+
            </div>
            <div class="produk-pengiriman">
                <div class="fw-semibold">
                    Pengiriman
                </div>
                <span class="bx bx-map me-1"></span>Dikirim dari <span class="fw-semibold">{{
                    $products->store->kabupaten_toko }}</span><br>
                <span class="bx bx-cube-alt me-1"></span>Berat <span class="fw-semibold">{{
                    $products->berat_produk }} Kg</span>
            </div>
            <div class="harga-produk fw-semibold" id="harga">
                Rp {{ number_format($products->harga, 0, ',') }}
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    <img src="{{asset('storage/'.$products->store->photo_toko)}}" class="foto-penjual-inproduk" alt="">
                </div>
                <div class="col-5">
                    <div class="nama-penjual-inproduk fw-semibold">
                        {{ $products->store->nama_toko }}
                    </div>
                    <div class="pesanan-proses-inproduk">
                        ± 1 Jam pesanan diproses
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-atur-jumlah fw-semibold">
                        Atur Jumlah
                    </div>
                    <div class="input-group mt-2">
                        <button onclick="updateQuantity(-1)" class="btn btn-outline-secondary" type="button">
                            <span class="bx bx-minus"></span>
                        </button>
                        <input id="quantityInput" type="number" class="form-control text-center w-25" min="1" max="10"
                            value="1" oninput="updateTotal()">
                        <button onclick="updateQuantity(1)" class="btn btn-outline-secondary" type="button">
                            <span class="bx bx-plus"></span>
                        </button>
                    </div>
                    <div class="max-pembelian">
                        Max. pembelian 50 pcs
                    </div>
                    <div class="stok">
                        Stok: <span id="stok" class="fw-semibold">{{$products->stok}}</span>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="subtotal">
                                Subtotal
                            </div>
                        </div>
                        <div class="col text-end fw-semibold">
                            <div id="total" class="total">
                                Rp {{ number_format($products->harga, 0, ',') }}
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn login-btn">+ Keranjang</button>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <a href="javascript:void(0);" onclick="buyNow('{{ $products->slug }}')"
                            class="btn btn-outline-login">Beli</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-5 mb-5">
            <div class="card">
                <div class="card-header">
                    Deskripsi Produk
                </div>
                <div class="card-body">
                    {!! $products->description !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    var initialQuantity = 1;
    var initialTotal = {{ $products->harga }}; // Set initial total based on the product's price
    var initialBerat = {{ $products->berat_produk }};

    function updateQuantity(amount) {
        var quantityInput = document.getElementById("quantityInput");
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + amount;

        if (newQuantity >= 1 && newQuantity <= 10) {
            quantityInput.value = newQuantity;
            updateTotal();
        }
    }

    function updateTotal() {
    var quantityInput = document.getElementById("quantityInput");
    var totalElement = document.getElementById("total");
    var stokElement = document.getElementById("stok");
    var hargaElement = document.getElementById("harga");

    var quantity = parseInt(quantityInput.value);
    var stok = parseInt(stokElement.textContent);
    var pricePerItem = parseFloat(hargaElement.textContent.replace("Rp", "").replace(",", ""));

    var newTotal = quantity * pricePerItem;
    var newBerat = quantity * initialBerat; // Lakukan perhitungan berat baru

    if (quantity > stok) {
        alert("The requested quantity exceeds the available stock.");
        quantityInput.value = stok;
        newTotal = stok * pricePerItem;
    }

    totalElement.textContent = "Rp " + newTotal.toLocaleString();
    initialQuantity = quantity; // Update initial quantity
    initialTotal = newTotal; // Update initial total
    initialBerat = newBerat;
}

    function buyNow(slug) {
    // Construct the URL with updated quantity and total
    var url = "/beli-langsung/" + slug + "?quantity=" + initialQuantity + "&total=" + initialTotal + "&berat=" + initialBerat;
    
    // Redirect to the constructed URL
    window.location.href = url;
    }
</script>
@endpush