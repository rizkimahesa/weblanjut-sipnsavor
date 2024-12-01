@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Navbar -->
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

    <!-- Padding Top to Adjust Content Below Navbar -->
    <div class="container mt-5 pt-4">
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @endif

        <!-- Menu List -->
        <h1 class="mb-4">Menu List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->nama }}</td>
                    <td>{{ $menu->deskripsi }}</td>
                    <td>Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td>
                    @if($menu->foto)
                    <img src="{{ asset('storage/'.$menu->foto) }}" alt="Menu Image" width="50" height="50">
                    @else
                        <img src="{{ asset('default-photo.png') }}" alt="Default Foto" width="50" height="50">
                    @endif
                </td>
                    <td>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu item?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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