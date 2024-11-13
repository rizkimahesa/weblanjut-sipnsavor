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
                    <img src="{{ asset($menu->foto) }}" class="card-img-top menu-image" alt="Menu Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->nama }}</h5>
                        <p class="card-text">{{ $menu->deskripsi }}</p>
                        <p class="text-success fw-bold">Rp{{ $menu->harga }}</p>

                        <!-- Order Button -->
                        <a href="{{ route('cart.store') }}" class="btn btn-primary" 
                           onclick="event.preventDefault(); 
                           document.getElementById('add-to-cart-form-{{ $menu->id }}').submit();">
                           Order
                        </a>

                        <!-- Hidden Form for Adding to Cart -->
                        <form id="add-to-cart-form-{{ $menu->id }}" action="{{ route('cart.store') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="Nama_Makanan" value="{{ $menu->nama }}">
                            <input type="hidden" name="Foto" value="{{ asset($menu->foto) }}">
                            <input type="hidden" name="Harga" value="{{ $menu->harga }}">
                            <input type="number" name="Pesanan" min="1" value="1" required>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
