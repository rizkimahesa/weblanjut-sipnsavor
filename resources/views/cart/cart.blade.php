<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@extends('layouts.dashboard')

@section('content')
<div class="tab-pane" style="padding-bottom: 50px" role="tabpanel" aria-labelledby="cart-tab">
    <div class="container mt-5">
        <h2 class="text-success">Your Cart</h2>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <div class="text-center mt-4">
                <h4>Your cart is now empty.</h4>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @else
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Food Name</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/'.$item->foto ?? 'storage/images/default-food.jpg') }}" alt="Food Photo" style="height: 100px; object-fit: cover;">
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->Pesanan }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                            @php $total += $item->harga * $item->Pesanan; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <h5 class="me-4">Total: Rp{{ number_format($total, 0, ',', '.') }}</h5>
                <div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    @foreach ($cartItems as $item)
                    <input type="hidden" name="menu_id[]" value="{{ $item->id }}">
                    <input type="hidden" name="quantity[]" value="{{ $item->Pesanan }}">
                    @endforeach
                    <button type="submit" class="btn btn-success">Order</button>
                </form>

                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</div>
@endsection

</body>
</html>
