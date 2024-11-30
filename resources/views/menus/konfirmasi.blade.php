@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-success mb-4">Admin Orders</h2>
     <!-- Tombol Kembali ke Halaman Sebelumnya -->
    <div class="mt-4">
        <a href="{{ route('menus.index') }}" class="btn btn-primary btn-lg">Kembali ke Menu</a>
    </div>

    <!-- Notifikasi pesan sukses atau error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Pesanan Pending -->
    <h4 class="text-primary mb-3">Pesanan Pending</h4>
    @if ($orders->where('status', 'pending')->isEmpty())
        <p class="text-muted">Tidak ada pesanan yang pending.</p>
    @else
        @foreach ($orders->where('status', 'pending') as $order)
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Order #{{ $order->id }} - Status: {{ ucfirst($order->status) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto Makanan, Nama User, dan No HP User -->
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'.$order->menu->foto) }}" alt="{{ $order->menu->nama }}" class="img-fluid" style="max-height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <p class="fw-bold">Menu: <span class="text-muted">{{ $order->menu->nama }}</span></p>
                            <p class="fw-bold">Jumlah: <span class="text-muted">{{ $order->quantity }}</span></p>
                            <p class="fw-bold">Harga: <span class="text-success">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p class="fw-bold">Nama User: <span class="text-muted">{{ $order->user->name }}</span></p>
                            <p class="fw-bold">No HP User: <span class="text-muted">{{ $order->user->no_hp }}</span></p>
                        </div>
                    </div>
                    <!-- Konfirmasi Tombol -->
                    <div class="text-end">
                        <a href="{{ route('admin.orders.confirm', $order->id) }}" class="btn btn-success btn-lg">Konfirmasi Pesanan</a>
                    </div>
                    <hr>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection
