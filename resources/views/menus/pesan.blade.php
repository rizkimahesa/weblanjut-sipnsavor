<!-- resources/views/menus/pesan.blade.php -->
@extends('layouts.app')

@section('content')
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
@endsection
