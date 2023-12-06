@extends('layouts.app')

@section('content')
<div class="container register-store">
    <div class="row">
        <div class="col-sm-4 mx-auto">
            <a href="/" class="d-flex no-underline back">
                <i class='bx bx-left-arrow-alt bx-md'></i>
                <span class="mt-2">Kembali</span>
            </a>
            <h1 class="sign-in h3 font-weight-bold mt-4 pt-1">
                Register Toko
            </h1>
            <p class="text secondary h8 mt-3 mb-3">Mulai berjualan di Tokotani sekarang!</p>
            <div class="border rounded-lg text-center p-3">
                <img id="preview" src="https://via.placeholder.com/140?text=IMAGE" alt="your image" class="mt-3" />
            </div>
            <form action="/pendaftaran-toko" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <label>Tambahkan Foto Toko Anda</label>
                    <input type="file" class="form-control" name="photo_toko" id="selectImage" @error('photo_toko')
                        is-invalid @enderror required>
                    @error('photo_toko')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="nama_toko" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="nama_toko" name="nama_toko" @error('nama_toko')
                        is-invalid @enderror required>
                    @error('nama_toko')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn login-btn">Register</button>
                </div>
            </form>
        </div>
    </div>
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