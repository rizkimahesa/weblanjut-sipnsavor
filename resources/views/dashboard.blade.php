<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap CSS from CDN -->
    <style>
        .menu-image {
            height: 200px; /* Atur tinggi gambar */
            object-fit: cover; /* Memastikan gambar terpotong dengan baik tanpa merusak rasio */
        }
        .contact-form-container {
            max-width: 600px; /* Atur lebar maksimal form */
            margin: auto; /* Memposisikan form di tengah */
            padding: 2rem; /* Tambahkan padding untuk tampilan yang lebih baik */
            background: rgba(255, 255, 255, 0.8); /* Background putih dengan transparansi */
            border-radius: 8px; /* Membuat sudut yang lebih halus */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Menambahkan shadow untuk efek kedalaman */
        }
    </style>

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

    @yield('content')

    <div class="tab-content">
        <!-- Home Tab -->
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h1 class="text-success">Welcome to SIP & SAVOR</h1>
        </div>
        
<!-- Order Tab -->
<div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
    <h2 class="text-success">Order Menu</h2>

    <!-- Display Menu Items -->
    <div class="row">
        @foreach($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($menu->foto) }}" class="card-img-top menu-image" alt="Menu Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nama }}</h5>
                        <p class="card-text">{{ $menu->deskripsi }}</p>
                        <p class="text-success fw-bold">Rp{{ $menu->harga }}</p>

                        <!-- Order Button -->
                        <a href="{{ route('cart.store') }}" class="btn btn-primary" 
                           onclick="event.preventDefault(); 
                           document.getElementById('add-to-cart-form-{{ $menu->id }}').submit();">
                           Order
                        </a>

                        <!-- Hidden Form for Adding to Cart -->
                        <form id="add-to-cart-form-{{ $menu->id }}" action="{{ route('cart.store') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="Nama_Makanan" value="{{ $menu->nama }}">
                            <input type="hidden" name="Foto" value="{{ asset($menu->foto) }}">
                            <input type="hidden" name="Harga" value="{{ $menu->harga }}">
                            <input type="number" name="Pesanan" min="1" value="1" required>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


        <!-- Contact Tab -->
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="contact-form-container mt-4">
                <h2 class="text-success text-center">Contact Us</h2>

                <!-- Display Success Message -->
                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Contact Form -->
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Send</button>
                </form>
            </div>
        </div>

        <!-- Cart Tab -->
        <div class="tab-pane fade" id="cart" role="tabpanel" aria-labelledby="cart-tab">
            <h2 class="text-success">Your Cart</h2>

            @if($cartItems->isEmpty())
                <p class="text-danger">Your cart is empty.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Makanan</th>
                                <th>Pesanan</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->Nama_Makanan }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp{{ $item->Harga }}</td>
                                    <td>Rp{{ $item->Harga * $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
