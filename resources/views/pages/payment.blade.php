@extends('layouts.app')
@section('content')
<div class="container mx-auto h-100vh">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col w-500px">
            <div class="card">
                <div class="card-header">
                    <i class='bx bx-arrow-back'></i>
                    <span class="ms-1">Kembali</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">Total Pembayaran</div>
                        <div class="col-6 text-end">Rp 70.000</div>
                        <div class="col-6">Bayar Dalam</div>
                        <div class="col-6 text-end">23 jam 47 menit 54 detik</div>
                        <div class="col-6">Bank BCA</div>
                        <div class="col-6 text-end">126 0821 5394 1209</div>
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" class="btn btn-outline-login">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection