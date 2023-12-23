@extends('admin.app')
@section('content')
<div class="container mt-3 ms-3">
    <h1 class="">Kategori</h1>
    <hr class="mt-3">
    <form action="/admin/category/baru" method="post">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Masukan Kategori</label>
            <input type="text" class="form-control" id="category" name="nama">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr class="mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        {{-- @if(isset($categories)) --}}
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$category->nama}}</td>
                <td><a class="link-danger link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-danger"
                        href="/admin/category/{{$category->slug}}" data-confirm-delete="true">Hapus</a></td>
            </tr>
            @endforeach
        </tbody>
        {{-- @endif --}}
    </table>
</div>
@endsection