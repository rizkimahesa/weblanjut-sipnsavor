<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::all(); // Mengambil semua item dari cart
        return view('cart.index', compact('cartItems'));
    }

    public function dashboard()
    {
    $cartItems = Cart::all(); // Ambil semua item dari cart
    $menus = Cart::all(); // Ambil semua menu, jika perlu
    return view('dashboard', compact('cartItems', 'menus')); // Kirimkan kedua variabel ke view
    }

    public function store(Request $request)
{
    $request->validate([
        'food_name' => 'required|string|max:255',
        'photo' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'required|integer|min:1',
    ]);

    // Cek apakah item sudah ada di cart
    $existingItem = Cart::where('Nama_Makanan', $request->Nama_Makanan)->first();

    if ($existingItem) {
        // Jika sudah ada, tambahkan jumlahnya
        $existingItem->quantity += $request->quantity;
        $existingItem->save();
    } else {
        // Jika belum ada, simpan item baru
        Cart::create($request->all());
    }

    return redirect()->route('cart.index')->with('success', 'Item added to cart!');
}
}