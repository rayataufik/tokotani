@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="">Edit Toko</h1>
    <div class="row justify-content-center">
        <div class="col-3 mt-3 photo_toko">
            <img id="preview" src="{{ asset('storage/' . $sellerCenter->photo_toko) }}" alt="photo_toko" class="rounded"
                style="width: 250px; height: 250px;">
        </div>
    </div>
    <form action="/seller/profile/{{$sellerCenter->slug}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row justify-content-center">
            <div class="col-9 mb-3">
                <label>Foto Toko</label>
                <input type="file" class="form-control" name="photo_toko" id="selectImage" @error('photo_toko')
                    is-invalid @enderror>
                @error('photo_toko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="nama_toko" class="form-label">Nama Toko</label>
                <input type="text" class="form-control" id="nama_toko"
                    value="{{old('nama_toko',$sellerCenter->nama_toko)}}" name="nama_toko" required>
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="provinsi_toko" class="form-label">Provinsi</label>
                <input type="text" class="form-control" id="provinsi_toko"
                    value="{{old('provinsi_toko',$sellerCenter->provinsi_toko)}}" name="provinsi_toko" required>
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kabupaten_toko" class="form-label">Kabupaten</label>
                <input type="text" class="form-control" id="kabupaten_toko"
                    value="{{old('kabupaten_toko',$sellerCenter->kabupaten_toko)}}" name="kabupaten_toko" required>
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kecamatan_toko" class="form-label">Kecamatan</label>
                <input type="text" class="form-control" id="kecamatan_toko"
                    value="{{old('kecamatan_toko',$sellerCenter->kecamatan_toko)}}" name="kecamatan_toko" required>
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="kode_pos_toko" class="form-label">Kode Pos</label>
                <input type="number" class="form-control" id="kode_pos_toko"
                    value="{{old('kode_pos_toko',$sellerCenter->kode_pos_toko)}}" name="kode_pos_toko" required>
            </div>
            <div class="col-9 mb-3 mt-3">
                <label for="detail_alamat_toko" class="form-label">Alamat</label>
                <textarea class="form-control" id="detail_alamat_toko" rows="4" name="detail_alamat_toko"
                    required>{{ old('detail_alamat_toko', $sellerCenter->detail_alamat_toko) }}</textarea>
            </div>
            <div class="col-9 d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-5">
                <a class="btn btn-primary" href="/seller/profile/" role="button">Kembali</a>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('script')
<script>
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        // preview.style.display = 'block';
        preview.style.width = '200px';
        preview.style.height = '200px';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush