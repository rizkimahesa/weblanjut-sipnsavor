@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Menu</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach ($menus as $menu)
        <div>
            <h2>{{ $menu->nama }} - ${{ $menu->harga }}</h2>
            <p>{{ $menu->deskripsi }}</p>
            <!-- Pass the menu ID to the Order creation route -->
            <a href="{{ route('orders.create', ['menuId' => $menu->id]) }}" class="btn btn-primary">Order</a>
        </div>
    @endforeach
</div>
@endsection
