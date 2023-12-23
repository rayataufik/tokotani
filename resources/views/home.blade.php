<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokotani</title>

    <link rel="icon" type="image/png" href="{{ secure_asset('assets/images/Favicon.png') }}">
    <!-- CSS Start -->
    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS End -->
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- google font -->
</head>

<body>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    @include('sweetalert::alert')
    @include('layouts.navbar')
    @include('layouts.carousel')
    <div class="container">
        <div class="row mt-5">
            <div class="col produk-pilhan fw-semibold">
                Produk Pilihan
            </div>
            {{-- <div class="col text-end lihat-semua">
                Lihat Semua
            </div> --}}
        </div>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-3 mt-4">
                <div class="card" style="width: 19rem;">
                    <img src="{{ asset('storage/' . $product->photo_produk) }}" class="card-img-top" alt="..."
                        style="object-fit: cover; width: 303px; height: 206px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">{{ substr(strip_tags($product->description), 0, 100) }}...</p>
                        <p>Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <a href="/produk/{{$product->slug}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="jumbotron">
            @include('layouts.jumbotron')
        </div>
    </div>
    @include('layouts.footbar')

    <!-- JS Start -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    {{-- <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script> --}}
    <!-- JS End -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>
    @stack('script')
</body>

</html>