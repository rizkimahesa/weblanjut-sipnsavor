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

        /* Atur hover state */
        .nav-tabs .nav-link:hover {
            background-color: rgba(40, 167, 69, 0.2); /* Warna background pada hover */
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="vh-100" style="
        background: url('{{ asset('images/kopi.png') }}') no-repeat center center; 
        background-size: cover; 
        background-attachment: fixed;
        display: flex;
        flex-direction: column;">
        
        
    
    <nav class="navbar navbar-expand-lg navbar-light py-3" style="background-color: #DCDCDC">
        <div class="container-fluid justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logonavbar.png') }}" height="70" alt="logo">
            </a>
            <button class="navbar-toggler btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="d-flex align-items-center">
                    <ul class="nav nav-tabs me-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} text-success fw-bold" href="{{ route('dashboard') }}" role="tab">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('order') ? 'active' : '' }} text-success fw-bold" href="{{ route('order') }}" role="tab">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }} text-success fw-bold" href="{{ route('contact') }}" role="tab">Contact</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }} text-success fw-bold" href="{{ route('cart.index') }}" role="tab">Cart</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('history') ? 'active' : '' }} text-success fw-bold" href="{{ route('history') }}" role="tab">History</a>

                    </li>
                    <!-- Logout Button -->
    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
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
    

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 " style="
        position: bottom;">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>123 Cafe Street, Coffee City, 45678</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                </div>
                <div class="col-md-4">
                    <h5>Hours</h5>
                    <p>Mon - Fri: 8:00 AM - 8:00 PM</p>
                    <p>Sat - Sun: 9:00 AM - 10:00 PM</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>