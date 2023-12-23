@extends('admin.app')
@section('content')
<div class="container mt-3 ms-3">
    <h3>Penarikan Saldo User</h3>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Saldo</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Menampilkan data nama, saldo, dan status_penarikan_saldo dari tabel users --}}
            @foreach ($userRequest as $userRequest)
            <tr>
                <th scope="row">{{ $loop->iteration}}</th>
                <td>{{ $userRequest->fullname }}</td>
                <td>{{ $userRequest->saldo }}</td>
                <td>{{ $userRequest->status_penarikan_saldo }}</td>
                <td><a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-success"
                        href="/admin/penarikan-user/{{$userRequest->id}}">Kirim Sekarang</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Penarikan Saldo Seller</h3>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Saldo</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Menampilkan data nama, saldo, dan status_penarikan_saldo dari tabel stores --}}
            @foreach ($storeRequest as $storeRequest)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $storeRequest->nama_toko }}</td>
                <td>{{ $storeRequest->saldo }}</td>
                <td>{{ $storeRequest->status_penarikan_saldo }}</td>
                <td><a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover text-success"
                        href="/admin/penarikan/{{$storeRequest->slug}}">Kirim Sekarang</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection