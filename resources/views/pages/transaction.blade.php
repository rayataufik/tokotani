@extends('pages.app')

@section('content')
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
                Raya Taufik
            </div>
            <div class="no-hp">
                082131312313
            </div>
            <div class="alamat">
                Gang Pasalipan, No. 08, RT. 01, RW. 06, Desa lengkong, Kecamatan Bojongsoang, Kab. Bandung, 40287
                Bojong Soang, Kab. Bandung, 40287
            </div>
            <hr>
            <div class="produk-checkout">
                <div class="row">
                    <div class="col-1">
                        <img src="{{ asset('assets/images/beras.png') }}"
                            class="rounded float-start foto-produk-checkout" alt="...">
                    </div>
                    <div class="col-3 ms-3">
                        Terong Ungu Premium <br>
                        1 Barang & 1 Kg <br>
                        <h6>Rp 60.000</h6>
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
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                COD (Bayar Ditempat)
                            </button>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-inline">
                            <button class="btn btn-outline-login" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Transfer Bank
                            </button>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <h6>Pilihan Bank</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Bank BCA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Bank BNI
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Bank BCA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault4">
                                Bank BNI
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
                            Total Harga (1 Produk)
                        </div>
                        <div class="col-5 text-end">
                            Rp 20.000
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
                        <div class="col-6 text-end mt-5">
                            <h6>Rp 18.000</h6>
                        </div>
                        <div class="d-grid gap-2 mt-2">
                            <button type="submit" class="btn btn-outline-login">Bayar Sekarang</button>
                        </div>
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
@endsection