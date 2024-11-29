<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu; // Import the Menu model
use Illuminate\Http\Request;
use App\Models\Cart;

class OrderController extends Controller
{
    public function create()
    {
        // Get all menus to display in the order form
        $menus = Menu::all();

        $selectedMenu = null;
        if ($menus) {
            $selectedMenu = Menu::find($menus);
        }

        return view('orders.create', compact('menus'));
    }

    public function index()
{
    // Ambil semua menu
    $menus = Menu::all(); 

    // Kirim data menus dan orders ke view
    $orders = Order::with('menu')->get();
    return view('order', compact('orders', 'menus')); // Kirim kedua variabel
}


public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'quantity' => 'required|integer|min:1',
    ]);

    // Ambil data menu berdasarkan menu_id
    $menu = Menu::findOrFail($validated['menu_id']);

    // Menyimpan data ke dalam tabel cart
    Cart::create([
        'user_id' => auth()->id(),
        'menu_id' => $validated['menu_id'],
        'nama' => $menu->nama,
        'harga' => $menu->harga,
        'Pesanan' => $validated['quantity'],
        'foto' => $menu->foto,
    ]);

    return redirect()->route('cart.index')->with('success', 'Menu added to cart!');
}







    public function checkout(Request $request)
{
    // Ambil cart items milik user yang sedang login
    $cartItems = Cart::where('user_id', auth()->id())->get();
    
    // Proses setiap item dan simpan ke tabel orders
    foreach ($cartItems as $item) {
        Order::create([
            'user_id' => $item->user_id,
            'menu_id' => $item->menu_id,
            'quantity' => $item->Pesanan,
            'total_price' => $item->harga * $item->Pesanan,
        ]);
    }

    // Hapus cart setelah checkout
    Cart::where('user_id', auth()->id())->delete();

    return redirect()->route('orders.history')->with('success', 'Your order has been placed!');
}





    public function history()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.history', compact('orders'));
    }

    

}

