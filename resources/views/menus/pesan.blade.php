<!-- resources/views/menus/pesan.blade.php -->
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
    <h1 class="mb-4">Pesan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Tombol Kembali ke Halaman Sebelumnya -->
    <div class="mt-4">
        <a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg">Kembali ke Menu</a>
    </div>

    <!-- Daftar Pesan -->
    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th> <!-- Kolom Aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach($pesans as $pesan)
            <tr>
                <td>{{ $pesan->user->name }}</td> <!-- Menampilkan nama user -->
                <td>{{ $pesan->message }}</td>
                <td>{{ $pesan->created_at->format('d-m-Y') }}</td> <!-- Menampilkan tanggal pesan -->
                <td>
                    <form action="{{ route('pesan.destroy', $pesan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this message?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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