<!-- orders/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Place an Order</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        
        <!-- Menu Selection -->
        <div class="mb-3">
            <label for="menu_id" class="form-label">Menu</label>
            <select name="menu_id" id="menu_id" class="form-control" required>
                <option value="">Select Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ (isset($selectedMenu) && $selectedMenu->id == $menu->id) ? 'selected' : '' }}>
                        {{ $menu->nama }} - ${{ $menu->harga }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <!-- Customer Name -->
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
