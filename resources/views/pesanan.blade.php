@extends('layouts.dashboard')

@section('content')
<div class="tab-pane" style="padding-bottom: 50px" role="tabpanel" aria-labelledby="contact-tab">

<div class="container mt-5">
    <h2 class="text-primary mb-4">Status Pesanan Anda</h2>

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

    <h4 class="mb-3">Pesanan Pending</h4>
    @if ($orders->isEmpty())
        <p class="text-muted">Anda tidak memiliki pesanan yang sedang pending.</p>
    @else
        @foreach ($orders as $order)
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Order #{{ $order->id }} - Status: {{ ucfirst($order->status) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto Makanan, Nama Menu, dan Harga -->
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'.$order->menu->foto) }}" alt="{{ $order->menu->nama }}" class="img-fluid" style="max-height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <p class="fw-bold">Menu: <span class="text-muted">{{ $order->menu->nama }}</span></p>
                            <p class="fw-bold">Jumlah: <span class="text-muted">{{ $order->quantity }}</span></p>
                            <p class="fw-bold">Harga: <span class="text-success">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p class="fw-bold">Tanggal dan Waktu Pemesanan: <span class="text-muted">{{ $order->created_at }}</span></p>

                        </div>
                    </div>

                    <hr>

                    <!-- Tombol Batalkan Pesanan -->
                    @if ($order->status == 'pending')
                        <form action="{{ route('user.pesanan.cancel', $order->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="text-end">
                                <button type="submit" class="btn btn-danger btn-lg">Batalkan Pesanan</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
</div>
@endsection
