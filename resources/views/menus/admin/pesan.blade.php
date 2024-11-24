@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0056b3;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Menu Management</a>
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
    <h1 class="mb-4">Pesan Menu</h1>
    <div class="row">
    <h2 class="mb-4 mt-5">Pesan-pesan yang Dikirimkan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->message }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
