@extends('layouts.dashboard')

@section('content')
<!-- Cart Tab -->
<div class="container tab-pane" role="tabpanel" aria-labelledby="cart-tab">
    <h2 class="text-success">Your Cart</h2>

   @if($cartItems->isEmpty())
        <p class="text-danger" style="padding-bottom: 450px">Your cart is empty.</p>
    @else
        <div class="table-responsive">
           <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Makanan</th>
                        <th>Pesanan</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->Nama_Makanan }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ $item->Harga }}</td>
                            <td>Rp{{ $item->Harga * $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
