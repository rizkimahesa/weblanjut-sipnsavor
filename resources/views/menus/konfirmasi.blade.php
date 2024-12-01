@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 0, 0, 0.3); position: fixed; top: 0; left: 0; width: 100%; z-index: 1030;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-7"> <!-- Menambahkan margin lebih besar pada ul -->
                    <li class="nav-item">
                        <a class="nav-link text-white rounded-hover" href="{{ route('menus.create') }}">Add New Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white rounded-hover" href="{{ route('admin.orders.konfirmasi') }}">Konfirmasi Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white rounded-hover" href="{{ route('pesan.index') }}">View Pesan</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex ms-2"> <!-- Menambahkan margin lebih besar untuk tombol logout -->
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </div>
        </div>
    </nav>
<div class="container mt-5 pt-4">
    <h2 class="text-center text-success mb-4">Konfirmasi Pesanan</h2>
    <div class="mb-4 text-center">
        <a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i> Kembali ke Menu
        </a>
    </div>
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Pesanan Pending -->
    <div class="row">
        @forelse ($orders->where('status', 'pending') as $order)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-header bg-warning text-white text-center">
                    <h5 class="mb-0">Order #{{ $order->id }} - Status: {{ ucfirst($order->status) }}</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/'.$order->menu->foto) }}" alt="{{ $order->menu->nama }}" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover;">
                    <h6 class="fw-bold text-primary">{{ $order->menu->nama }}</h6>
                    <p class="mb-1"><strong>Jumlah:</strong> {{ $order->quantity }}</p>
                    <p class="mb-1"><strong>Harga:</strong> <span class="text-success">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                    <p class="mb-1"><strong>Nama Pemesan:</strong> {{ $order->user->name }}</p>
                    <p><strong>No HP:</strong> {{ $order->user->no_hp }}</p>
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.orders.confirm', $order->id) }}" class="btn btn-success w-100">
                            <i class="fas fa-check-circle"></i> Konfirmasi Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center">
            <p class="text-muted">Tidak ada pesanan yang pending.</p>
        </div>
        
        @endforelse
    </div>
    
</div>

<!-- Tambahkan Font Awesome dan Gaya Tambahan -->
@push('styles')
<style>
     /* Navbar transparency and text styles */
     .navbar-light {
        background-color: rgba(0, 0, 0, 0.3) !important;
    }
    .navbar-brand,
    .nav-link {
        color: white !important;
    }
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
    }
    .ms-7 {
        margin-left: 5rem !important; /* Margin lebih besar untuk ul */
    }
    .ms-4 {
        margin-left: 2.5rem !important; /* Margin lebih besar untuk tombol logout */
    }
    /* Card with hover effect */
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Button hover effect */
    .btn {
        transition: all 0.3s ease-in-out;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    /* Margin and styling for image */
    .img-fluid {
        border-radius: 10px;
        object-fit: cover;
    }
</style>
@endpush
@endsection