@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h2 class="">Edit Produk</h2>
    <div class="border rounded text-center p-3">
        <img id="preview" src="{{asset('storage/'.$product->photo_produk)}}" alt="your image" class="mt-3"
            style="width: 200px; height: 200px;" />
    </div>
    <form action="/seller/produk/{{$product->slug}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mt-3">
            <label>Edit Foto Produk Anda</label>
            <input type="file" class="form-control" name="photo_produk" id="selectImage" @error('photo_produk')
                is-invalid @enderror>
            @error('photo_produk')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="title"
                value="{{ old('title', $product->title)}}" @error('title') is-invalid @enderror required>
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="kategori" class="form-label">Pilih Kategori</label>
            <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mt-3">
            <label for="description" class="form-label">Deskripsi Produk</label>
            <input id="description" type="hidden" name="description"
                value="{{ old('description', $product->description)}}">
            <trix-editor input="description"></trix-editor>
        </div>
        <div class="mt-3">
            <label for="stok" class="form-label">Tambahkan Stok</label>
            <input type="number" class="form-control" id="stok"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="stok"
                value="{{ old('stok', $product->stok)}}">
        </div>
        <div class="mt-3">
            <label for="harga" class="form-label">Tambahkan Harga</label>
            <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control"
                id="harga" name="harga" value="{{ old('harga', $product->harga)}}">
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