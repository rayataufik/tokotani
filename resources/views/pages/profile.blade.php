@extends('pages.app')
@section('content')
<div class="container profile-pengguna">
    <div class="row justify-content-center">
        <h1 class="col-9">Profile Pengguna</h1>
    </div>
    <div class="row justify-content-center">
        @if(isset($alertMessage))
        <div class="col-9 alert alert-warning alert-dismissible fade show" role="alert">
            {{ $alertMessage }}
        </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-9 mb-3 mt-3">
            <label for="fullname" class="form-label">Nama</label>
            <input type="text" class="form-control" id="fullname" value="{{$user->fullname}}" readonly disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" value="{{$user->email}}" readonly disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="no_telepon_user" class="form-label">Nomor HP</label>
            <input type="number" class="form-control" id="no_telepon_user" value="{{$user->no_telepon_user}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="provinsi_user" class="form-label">Provinsi</label>
            <input type="text" class="form-control" id="provinsi_user" value="{{$user->provinsi_user}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kabupaten_user" class="form-label">Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten_user" value="{{$user->kabupaten_user}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kecamatan_user" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan_user" value="{{$user->kecamatan_user}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="kode_pos_user" class="form-label">Kode Pos</label>
            <input type="text" class="form-control" id="kode_pos_user" value="{{$user->kode_pos_user}}" readonly
                disabled>
        </div>
        <div class="col-9 mb-3 mt-3">
            <label for="detail_alamat_user" class="form-label">Alamat</label>
            <textarea class="form-control" id="detail_alamat_user" rows="4" readonly
                disabled>{{$user->detail_alamat_user}}</textarea>
        </div>
        <div class="col-9 d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-5">
            <a class="btn btn-primary" href="/user/profile/edit" role="button">Edit
                Profile</a>
        </div>
    </div>
</div>
@endsection