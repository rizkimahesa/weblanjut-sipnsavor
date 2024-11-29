@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Admin Orders</h2>

    @forelse ($orders as $order)
    <div class="card mb-3">
        <div class="card-header">
            Order #{{ $order->id }} - Status: {{ ucfirst($order->status) }}
        </div>
        <div class="card-body">
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->menu->nama }} (Qty: {{ $item->quantity }})</li>
                @endforeach
            </ul>
            
            <!-- Tombol untuk mengonfirmasi pesanan -->
            @if ($order->status == 'pending')
            <form action="{{ route('orders.confirm', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success">Confirm Order</button>
            </form>
            @endif
        </div>
    </div>
    @empty
        <p>No orders found.</p>
    @endforelse

    <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Back to Orders</a>
</div>
@endsection
