@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="">Profile Toko</h1>
    <div class="row justify-content-center">
        @if ($showAlert)
        <div class="col-9 alert alert-warning alert-dismissible fade show" role="alert">
            Profil petani belum lengkap. Harap tambahkan alamat toko.
        </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-3 mt-3 photo_toko">
            <img src="{{ asset('storage/' . $sellerCenter->photo_toko) }}" alt="Photo Profile" class="rounded"
                style="width: 250px; height: 250px;">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-9 mb-3 mt-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" class="form-control" id="nama_toko" value="{{$sellerCenter->nama_toko}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="provinsi_toko" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi_toko" value="{{$sellerCenter->provinsi_toko}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kabupaten_toko" class="form-label">Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten_toko" value="{{$sellerCenter->kabupaten_toko}}"
                readonly disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kecamatan_toko" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan_toko" value="{{$sellerCenter->kecamatan_toko}}"
                readonly disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kode_pos_toko" class="form-label">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos_toko" value="{{$sellerCenter->kode_pos_toko}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="detail_alamat_toko" class="form-label">Alamat</label>
            <textarea class="form-control" id="detail_alamat_toko" rows="4" readonly
                disabled>{{$sellerCenter->detail_alamat_toko}}</textarea>
        </div>
        <div class="col-9 d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-5">
            <a class="btn btn-primary" href="/seller/profile/{{$sellerCenter->slug}}/edit" role="button">Edit
                Profile</a>
        </div>
    </div>
</div>
@endsection