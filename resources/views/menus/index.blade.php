@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Menu List</h1>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-secondary mb-3">Logout</button>
    </form>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('menus.create') }}" class="btn btn-success mb-3">Add New Menu</a>

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
@endsection
