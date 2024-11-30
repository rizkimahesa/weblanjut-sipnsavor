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

    return redirect()->route('cart.cart')->with('success', 'Menu added to cart!');
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

    // Ambil menu yang dipesan berdasarkan ID
    $menus = Menu::whereIn('id', $cartItems->pluck('menu_id'))->get();

    // Tampilkan halaman order.blade.php dengan data
    return view('home', compact('menus'))->with('success', 'Your order has been placed!');
}






public function history()
{
    // Mengambil pesanan dengan status 'confirmed' atau 'cancelled'
    $orders = Order::whereIn('status', ['confirmed', 'cancelled'])
                   ->where('user_id', auth()->id())  // Pastikan hanya mengambil pesanan milik user yang sedang login
                   ->get();

    return view('history', compact('orders'));
}



    public function userOrders()
    {
        $orders = auth()->user()->orders()->where('status', 'pending')->get();

        return view('user.orders', compact('orders'));
    }


    
    // Membatalkan pesanan
    public function cancelPesanan($id)
{
    // Cari pesanan berdasarkan ID dan pastikan pesanan dalam status pending
    $order = Order::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->where('status', 'pending')
                  ->first();

    // Jika pesanan ditemukan
    if ($order) {
        // Ubah status pesanan menjadi cancelled
        $order->status = 'cancelled';
        $order->save();

        // Kembali ke halaman pesanan dengan pesan sukses
        return redirect()->route('user.pesanan')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Jika pesanan tidak ditemukan atau sudah dibatalkan, redirect dengan pesan error
    return redirect()->route('user.pesanan')->with('error', 'Pesanan tidak ditemukan atau sudah dibatalkan.');
}
    public function userPesanan()
{
    // Ambil pesanan pengguna yang sedang login dan statusnya 'pending'
    $orders = Order::where('user_id', auth()->id())
                   ->where('status', 'pending')
                   ->get();

    // Tampilkan halaman pesanan
    return view('pesanan', compact('orders'));
}
}

