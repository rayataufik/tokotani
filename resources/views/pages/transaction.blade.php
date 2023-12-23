@extends('pages.app')

@section('content')
<form action="/beli-langsung/process" method="post" id="checkoutForm" onsubmit="return validateForm()">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">
    <input type="hidden" name="berat" value="{{ $berat }}">
    <input type="hidden" name="sicepat" value="Sicepat">
    <div class="container transaction">
        <div class="row">
            <div class="col-8">
                <div class="title-checkout">
                    <h1>Checkout</h1>
                </div>
                <div class="title-alamat">
                    Alamat Pengiriman
                    <hr>
                </div>
                <div class="nama-pengiriman">
                    {{$user->fullname}}
                </div>
                <div class="no-hp">
                    {{$user->no_telepon_user}}
                </div>
                <div class="alamat mt-3">
                    @if($user->detail_alamat_user && $user->kecamatan_user && $user->kabupaten_user &&
                    $user->provinsi_user
                    && $user->kode_pos_user)
                    <p>{{ $user->detail_alamat_user }}, {{ $user->kecamatan_user }}, {{ $user->kabupaten_user }},
                        {{$user->provinsi_user }}, {{ $user->kode_pos_user }}
                    </p>
                    @else
                    <div class="alert alert-warning" role="alert">
                        Profil belum lengkap. Harap tambahkan alamat anda. <a href="/user/profile">Klik Disini!</a>
                    </div>
                    @endif
                </div>
                <hr>
                <div class="produk-checkout">
                    <div class="row">
                        <div class="col-1">
                            <img src="{{asset('storage/'.$product->photo_produk)}}"
                                class="rounded float-start foto-produk-checkout" alt="...">
                        </div>
                        <div class="col-3 ms-3">
                            Terong Ungu Premium <br>
                            {{$quantity}} Barang & {{$berat}} Kg <br>
                            <h6>Rp {{ number_format($total, 0, ',') }}</h6>
                        </div>
                        <div class="col-5"></div>
                        <div class="col">
                            <h6>Kurir Pilihan</h6>
                            Sicepat (Rp 18.000) Ubah <br>
                            Estimasi Tiba 2 - 3 Hari
                        </div>
                    </div>
                    <hr class="mt-4">
                    <div class="row mb-4">
                        <div class="col-3">
                            <div class="metode-pembayaran mb-3">
                                Metode Pembayaran
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-inline">
                                <button class="btn btn-outline-login" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                    Transfer Bank
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapse">
                        <div class="card card-body">
                            <h6>Pilihan Bank</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode_pembayaran" id="bca"
                                    value="bca">
                                <label class="form-check-label" for="bca">
                                    Bank BCA
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode_pembayaran" id="bni"
                                    value="bni">
                                <label class="form-check-label" for="bni">
                                    Bank BNI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode_pembayaran" id="bri"
                                    value="bri">
                                <label class="form-check-label" for="bri">
                                    Bank BRI
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="metode_pembayaran" id="cimb"
                                    value="cimb">
                                <label class="form-check-label" for="cimb">
                                    Bank CIMB
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h6>Ringkasan Belanja</h6>
                        <div class="row">
                            <div class="col-7">
                                Total Harga ({{$quantity}} Produk)
                            </div>
                            <div class="col-5 text-end">
                                Rp {{ number_format($total, 0, ',') }}
                            </div>
                            <div class="col-6">
                                Total Ongkos Kirim
                            </div>
                            <div class="col-6 text-end">
                                Rp 18.000
                            </div>
                            <div class="col-6">
                                <h5 class="mt-5">Total Tagihan</h5>
                            </div>
                            <div class="col-6 text-end mt-5" id="total_tagihan">
                                <h6>Rp {{ number_format($total + 18000, 0, ',') }}</h6>
                            </div>
                            @if($user->detail_alamat_user && $user->kecamatan_user && $user->kabupaten_user &&
                            $user->provinsi_user
                            && $user->kode_pos_user)
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-outline-login">Bayar Sekarang</button>
                            </div>
                            @else
                            <div class="d-grid gap-2 mt-2">
                                <button type="submit" class="btn btn-outline-login" disabled>Bayar Sekarang</button>
                            </div>
                            @endif

                            <div class="text-setuju mt-1">
                                Dengan melanjutkan, Saya setuju dengan Syarat &
                                Ketentuan yang berlaku.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function validateForm() {
        // Check if any radio button is checked
        var metodePembayaran = document.querySelector('input[name="metode_pembayaran"]:checked');
        if (!metodePembayaran) {
            alert('Silakan pilih metode pembayaran terlebih dahulu.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>
@endsection