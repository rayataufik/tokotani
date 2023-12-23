@php
$categories = \App\Models\Category::all();
@endphp
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('assets/images/Logo.png') }}" alt="Tokotani" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategori
          </a>
          <ul class="dropdown-menu">
            @foreach ($categories as $category)
            <li><a class="dropdown-item" href="/kategori/{{$category->slug}}">{{$category->nama}}</a></li>
            @endforeach
          </ul>
        </li>
      </ul>
      <form class="d-flex w-75 has-search" role="search" action="{{ secure_url('/search-transactions') }}" method="GET">
        <span class="bx bx-search form-control-feedback"></span>
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search">
      </form>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active me-2 ms-2" aria-current="page" href="#" data-bs-toggle="tooltip"
            data-bs-placement="bottom" title="Coming Soon">
            <img src="{{ asset('assets/images/shopping-cart.svg') }}" alt="Cart" height="20">
          </a>
        </li>
        <span class="line">|</span>
        @auth
        @if (auth()->user()->role == 'pelanggan')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, {{auth()->user()->fullname}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/order-list">Pembelian</a></li>
            <li><a class="dropdown-item" href="/pendaftaran-toko">Daftar Seller</a></li>
            <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/user/saldo">Saldo</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @elseif (auth()->user()->role == 'petani')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, {{auth()->user()->fullname}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/order-list">Pembelian</a></li>
            <li><a class="dropdown-item" href="/seller/dashboard">Seller Center</a></li>
            <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/user/saldo">Saldo</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @elseif (auth()->user()->role == 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, {{auth()->user()->fullname}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/order-list">Pembelian</a></li>
            <li><a class="dropdown-item" href="/admin/dashboard">Admin Center</a></li>
            <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/user/saldo">Saldo</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endif
        @else
        <a class="btn btn-outline-login ms-3" href="/login" role="button">Login</a>
        <a class="btn btn-register ms-3" href="/register" role="button">Register</a>
        @endauth
      </ul>
    </div>
  </div>
</nav>