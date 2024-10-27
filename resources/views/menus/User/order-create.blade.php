@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Place an Order</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="menu_id" class="form-label">Select Menu</label>
            <select name="menu_id" id="menu_id" class="form-control" required>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nama }} - ${{ $menu->harga }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="customer_name" class="form-label">Your Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
@endsection
