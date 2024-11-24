<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="vh-100" style="background: url('{{ asset('images/kopi.png') }}') no-repeat center center; background-size: cover;">

    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logoplainwh.png') }}" height="70" alt="logo">
            </a>
            <button class="navbar-toggler btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="d-flex align-items-center">
                    <ul class="nav nav-tabs me-4">
                        <li class="nav-item">
                            <a class="nav-link active text-success fw-bold" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-selected="false">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" data-bs-toggle="tab" role="tab" aria-selected="false" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" data-bs-toggle="tab" role="tab" aria-selected="false" href="#cart">Cart</a>
                        </li>
                    </ul>
                    <!-- Search -->
                    <div class="position-relative">
                        <input class="form-control rounded-pill pe-5 fw-bold" type="search" placeholder="Search" aria-label="Search">
                        <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y pe-3" style="font-size: 1rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="tab-content w-100">
            <!-- Home Tab -->
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h1 class="text-success text-center">Welcome to SIP & SAVOR</h1>
            </div>
            
            <!-- Order Tab -->
            <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                <h2 class="text-success text-center">Order Menu</h2>
                <p class="text-center">Select an item to place an order:</p>

                <!-- Display Menu Items -->
                <div class="row">
                    @foreach($menus as $menu)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset($menu->foto) }}" class="card-img-top" alt="Menu Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $menu->nama }}</h5>
                                    <p class="card-text">{{ $menu->deskripsi }}</p>
                                    <p class="text-success fw-bold">Rp{{ $menu->harga }}</p>
                                    <a href="{{ route('orders.create', ['menuId' => $menu->id]) }}" class="btn btn-primary">Order</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

<!-- Contact Tab -->
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <h2 class="text-success text-center">Contact Us</h2>
    
    <!-- Contact Form -->
    <div class="d-flex justify-content-center mt-5"> <!-- Menambahkan margin-top dan flexbox untuk pemusatan -->
        <form action="{{ route('contact.store') }}" method="POST" class="w-75"> <!-- Menambahkan lebar form -->
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Pesan</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>


            <!-- Cart Tab -->
            <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
                <h2 class="text-success">Your Cart</h2>
                <p>Items in your cart will be displayed here.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
