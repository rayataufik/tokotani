@extends('pages.app')
@section('content')
<div class="container profile-pengguna">
    <div class="row justify-content-center">
        <h1 class="col-9">Edit Profile Pengguna</h1>
    </div>
    <form action="/user/update" method="post">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="col-9 mb-3 mt-3">
                <label for="fullname" class="form-label">Nama</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="{{old('fullname',$user->fullname)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{old('email',$user->email)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="no_telepon_user" class="form-label">Nomor HP</label>
                <input type="number" class="form-control" id="no_telepon_user" name="no_telepon_user"
                    value="{{old('no_telepon_user',$user->no_telepon_user)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="provinsi_user" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="provinsi_user" name="provinsi_user"
                    value="{{old('provinsi_user',$user->provinsi_user)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kabupaten_user" class="form-label">Kabupaten</label>
                <input type="text" class="form-control" id="kabupaten_user" name="kabupaten_user"
                    value="{{old('kabupaten_user',$user->kabupaten_user)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kecamatan_user" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan_user" name="kecamatan_user"
                    value="{{old('kecamatan_user',$user->kecamatan_user)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kode_pos_user" class="form-label">Kode Pos</label>
                <input type="text" class="form-control" id="kode_pos_user" name="kode_pos_user"
                    value="{{old('kode_pos_user',$user->kode_pos_user)}}">
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="detail_alamat_user" class="form-label">Alamat</label>
                <textarea class="form-control" id="detail_alamat_user" name="detail_alamat_user"
                    rows="4">{{old('detail_alamat_user',$user->detail_alamat_user)}}</textarea>
            </div>
            <div class="col-9 d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-5">
                <a class="btn btn-primary" href="/user/profile" role="button">Kembali</a>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection