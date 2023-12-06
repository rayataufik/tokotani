@extends('layouts.app')
@section('content')
<div class="container mx-auto h-100vh">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col w-320px">
            <a href="/" class="d-flex no-underline back">
                <i class='bx bx-left-arrow-alt bx-md'></i>
                <span class="mt-2">Kembali</span>
            </a>
            <h1 class="sign-in h3 font-weight-bold mt-4 pt-1">
                Register
            </h1>
            <p class="text secondary h8 mt-3 mb-3">Daftar untuk melanjutkan belanja</p>
            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="FormControlInputName" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                        id="FormControlInputName" placeholder="Nama Lengkap" name="fullname" required
                        value="{{ old('fullname')}}">
                    @error('fullname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="FormControlInputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="FormControlInputEmail" placeholder="name@example.com" name="email" required
                        value="{{ old('email')}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="FormControlInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="FormControlInputPassword" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn login-btn">Register</button>
                </div>
                <p class="mt-3">Sudah punya akun? <a href="/login">Login</a></p>
            </form>
        </div>
    </div>
</div>
@endsection