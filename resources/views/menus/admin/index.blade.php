@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0056b3;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menus.create') }}">Tambah Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menus.pesan') }}">Pesan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menus.konfirmasi') }}">Konfirmasi Pesanan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <!-- Main Content -->
    <h1 class="mb-4">Menu List</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
                <td>Rp{{ $menu->harga }}</td>
                <td>
                    @if($menu->foto)
                    <img src="{{ asset($menu->foto) }}" alt="Menu Image" width="100">
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
@endsection
