@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h2 class="">Informasi Produk</h2>
    <div class="border rounded text-center p-3">
        <img id="preview" src="https://via.placeholder.com/140?text=IMAGE" alt="your image" class="mt-3" />
    </div>
    <form action="/seller/produk/baru" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label>Tambahkan Foto Produk Anda</label>
            <input type="file" class="form-control" name="photo_produk" id="selectImage" @error('photo_produk')
                is-invalid @enderror required>
            @error('photo_produk')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="title" value="{{ old('nama_produk')}}"
                @error('nama_produk') is-invalid @enderror required>
            @error('nama_produk')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="kategori" class="form-label">Pilih Kategori</label>
            <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{$category->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <input id="description" type="hidden" name="description" value="{{ old('description')}}">
            <trix-editor input="description"></trix-editor>
        </div>
        <div class="mt-3">
            <label for="stok" class="form-label">Tambahkan Stok</label>
            <input type="number" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                id="stok" name="stok" value="{{ old('stok')}}">
        </div>
        <div class="mt-3">
            <label for="harga" class="form-label">Tambahkan Harga</label>
            <input type="number" class="form-control" id="harga" name="harga"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Contoh 10000"
                value="{{ old('harga')}}">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 mb-5">
            <a class="btn btn-primary" href="/seller/produk/" role="button">Kembali</a>
            <button class="btn btn-primary" type="submit">Simpan</button>
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

    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })
</script>
@endpush