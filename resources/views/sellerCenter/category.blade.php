@extends('sellerCenter.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="">Kategori</h1>
    <hr class="mt-3">
    <form action="/seller/category" method="post">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Masukan Kategori</label>
            <input type="text" class="form-control" id="category" name="nama">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection