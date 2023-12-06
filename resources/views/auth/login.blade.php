@extends('layouts.app')
@section('content')
<div class="container mx-auto h-100vh">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col w-320px">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('loginError')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <a href="/" class="d-flex no-underline back">
                <i class='bx bx-left-arrow-alt bx-md'></i>
                <span class="mt-2">Kembali</span>
            </a>
            <h1 class="sign-in h3 font-weight-bold mt-4 pt-1">
                Login
            </h1>
            <p class="text secondary h8 mt-3 mb-3">Masuk untuk melanjutkan belanja</p>
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="FormControlInputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="FormControlInputEmail" placeholder="name@example.com" name="email" autofocus required
                        value="{{ old('email')}}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="FormControlInputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="FormControlInputPassword" name="password" required>
                </div>
                {{-- <div class="form-group form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Keep me logged in</label>
                </div> --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn login-btn">Login</button>
                </div>
                <p class="mt-3">Tidak punya akun? <a href="/register">Register</a></p>
            </form>
        </div>
    </div>
</div>
@endsection