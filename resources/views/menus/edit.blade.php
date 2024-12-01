@extends('layouts.app')

@section('content')
    <div class="container mt-5">
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
        <h1 class="mb-4">Edit Menu</h1>
                    <!-- Tombol Kembali ke Halaman Sebelumnya -->
    <div class="mt-4">
        <a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg">Kembali ke Menu</a>
    </div>

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 shadow rounded">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" name="nama" id="name" value="{{ $menu->nama }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" id="description" class="form-control" rows="3" required>{{ $menu->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga:</label>
                <input type="number" name="harga" id="price" value="{{ $menu->harga }}" step="0.01" class="form-control" required>
            </div>

            <div class="mb-3">
            <label for="foto">Foto:</label><br>
            <input type="file" id="foto" name="foto"><br><br>
            @if($menu->foto)
            <img src="{{ asset($menu->foto) }}" alt="menu Photo" width = "100" class = "mt-2">
            @endif
        </div>

            <button type="submit" class="btn btn-success">Update Menu</button>
        </form>
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
