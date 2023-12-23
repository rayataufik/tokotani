@extends('layouts.app')
@section('content')
<div class="container mx-auto h-100vh">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col w-500px">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('assets/images/Logo.png') }}" alt="Tokotani" height="50">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">Bank transfer</div>
                        <div class="col-6 text-end">{{ strtoupper($transaction->metode_pembayaran) }}</div>
                        <div class="col-6">Total Pembayaran</div>
                        <div class="col-6 text-end">Rp {{ number_format($transaction->total_tagihan, 0, ',') }}
                        </div>
                        <div class="col-6">Expired Time</div>
                        <div class="col-6 text-end">{{ $transaction->expiry_time }}</div>
                        <div class="col-6">Bank</div>
                        <div class="col-6 text-end">{{ $transaction->va_number }}</div>
                    </div>
                    <p class="mt-3">Cara Melakukan Pembayaran</p>
                    <ul>
                        <li>Kunjungi <a
                                href="https://simulator.sandbox.midtrans.com">https://simulator.sandbox.midtrans.com</a>
                        </li>
                        <li>pilih Virtual Account</li>
                        <li>pilih Bank Yang Anda Gunakan</li>
                    </ul>
                    <div class="d-grid gap-2 mt-2">
                        <a href="/order-list" class="btn btn-outline-login">Sudah Bayar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection