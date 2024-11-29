@extends('layouts.dashboard')

@section('content')
<!-- Order Tab -->
<div class="container tab-pane" role="tabpanel" aria-labelledby="order-tab">
    <h2 class="text-success">Order Menu</h2>

    <!-- Display Menu Items -->
    <div class="row">
        @foreach($menus as $menu)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$menu->foto) }}" class="card-img-top menu-image" alt="Menu Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nama }}</h5>
                        <p class="card-text">{{ $menu->deskripsi }}</p>
                        <p class="text-success fw-bold">Rp{{ $menu->harga }}</p>

                        <!-- Quantity Input -->
                        <label for="quantity-{{ $menu->id }}">Jumlah:</label>
                        <input type="number" id="quantity-{{ $menu->id }}" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 80px;">

                        <!-- Order Button -->
                        <a href="{{ route('cart.store') }}" class="btn btn-primary"
                           onclick="event.preventDefault(); 
                           document.getElementById('add-to-cart-form-{{ $menu->id }}').submit();">
                           Order
                        </a>

                        <!-- Hidden Form for Adding to Cart -->
                        <form id="add-to-cart-form-{{ $menu->id }}" action="{{ route('cart.store') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="hidden" name="quantity" id="hidden-quantity-{{ $menu->id }}" value="1">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Script for Updating Hidden Quantity -->
<script>
    // Update hidden quantity input before submitting the form
    document.querySelectorAll('input[name="quantity"]').forEach(input => {
        input.addEventListener('input', function() {
            const menuId = this.id.split('-')[1];
            const quantity = this.value;  // Get the value from input
            // Update the hidden input field
            document.getElementById('hidden-quantity-' + menuId).value = quantity;
        });
    });
</script>
@endsection
