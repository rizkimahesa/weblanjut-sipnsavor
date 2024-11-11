<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
{
    // Mengambil item cart untuk user yang sedang login
    $cartItems = Cart::where('user_id', Auth::id())->get();
    
    return view('cart.cart', compact('cartItems'));
}

    public function dashboard()
    {
    $cartItems = Cart::all(); // Ambil semua item dari cart
    $menus = Cart::all(); // Ambil semua menu, jika perlu
    return view('dashboard', compact('cartItems', 'menus')); // Kirimkan kedua variabel ke view
    }

    public function store(Request $request)
{
    // Validasi dan cek login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
    }

    // Validasi input
    $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'quantity' => 'required|integer|min:1',
    ]);

    $menu = Menu::find($request->menu_id);

    // Debugging: Periksa ID pengguna yang login
      // Pastikan ID pengguna yang login valid

    // Cek apakah item sudah ada di cart
    $existingItem = Cart::where('nama', $menu->nama)
                        ->where('user_id', Auth::id())
                        ->first();

    if ($existingItem) {
        // Jika sudah ada, tambahkan jumlah (quantity) nya
        $existingItem->Pesanan += $request->quantity;
        $existingItem->save();
    } else {
        // Jika belum ada, simpan item baru ke cart
        Cart::create([
            'user_id' => Auth::id(),
            'nama' => $menu->nama,
            'foto' => $menu->foto ?? 'default-food.jpg',  // Foto default jika tidak ada
            'harga' => $menu->harga,
            'Pesanan' => $request->quantity,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Item added to cart!');
}

    public function __construct()
    {
    $this->middleware('auth'); // Pastikan hanya pengguna yang login yang bisa mengakses
    }
    // Di dalam controller

    public function checkout(Request $request)
    {
        // Logika checkout (misalnya, memproses pembayaran atau status pesanan)
    
        // Cek jika pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login first!');
        }
    
        // Dapatkan item cart untuk user yang login
        $cartItems = Cart::where('user_id', Auth::id())->get();
    
        // Logika lain untuk checkout, seperti menyimpan data pesanan, dll.
        // Contoh: menghapus semua item cart setelah checkout
        Cart::where('user_id', Auth::id())->delete();
    
        return redirect()->route('cart.index')->with('success', 'Your order has been placed successfully!');
    }
    

}