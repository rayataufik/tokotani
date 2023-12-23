@if (auth()->user()->role == 'petani')
<div class="navbar-seller">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-sm">
            <ul class="navbar-nav ms-auto me-5">
                <!-- Add ms-auto class to move the content to the right -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi, {{auth()->user()->fullname}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="sidenav">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Tokotani" height="50">
    </a>
    <hr>
    <a href="/seller/dashboard">Dashboard</a>
    <a href="/seller/pesanan">Pesanan</a>
    <a href="/seller/produk">Produk</a>
    <a href="/seller/keuangan">Keuangan</a>
    <a href="/seller/profile">Profile</a>
</div>
@elseif (auth()->user()->role == 'admin')
<div class="navbar-seller">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-sm">
            <ul class="navbar-nav ms-auto me-5">
                <!-- Add ms-auto class to move the content to the right -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi, {{auth()->user()->fullname}}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="sidenav">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/Logo.png') }}" alt="Tokotani" height="50">
    </a>
    <hr>
    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/keuangan">Keuangan</a>
    <a href="/admin/category">Category</a>
</div>
@endif