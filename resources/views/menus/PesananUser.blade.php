<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pesanan</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                    <li class="nav-item">
                    <a class="nav-link text-white rounded-hover" href="{{ route('menus.PesananUser') }}">Riwayat pesanan</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex ms-2"> <!-- Menambahkan margin lebih besar untuk tombol logout -->
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Riwayat Pesanan</h1>

        <div class="mt-4">
        <a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg">Kembali ke Menu</a>
    </div>
        <!-- Tabel Riwayat Pesanan -->
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama Makanan</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->menu->nama }}</td> <!-- Menampilkan nama makanan -->
                        <td>{{ $order->quantity }}</td> <!-- Menampilkan jumlah pesanan -->
                        <td>Rp{{ number_format($order->menu->harga * $order->quantity, 0, ',', '.') }}</td> <!-- Harga total -->
                        <td>{{ $order->user->name }}</td> <!-- Menampilkan nama pelanggan -->
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td> <!-- Menampilkan tanggal pesanan -->
                        <td>{{ ucfirst($order->status) }}</td> <!-- Menampilkan status pesanan -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Skrip JavaScript Bootstrap (Optional, jika kamu membutuhkan interaksi tambahan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</div>
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
</style>
@endsection
</body>
</html>
