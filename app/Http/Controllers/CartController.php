<?php
namespace App\Http\Controllers;

use App\Models\Cart;        // Model Cart
use App\Models\Menu;        // Model Menu
use App\Models\Order;       // Model Order
use App\Models\OrderItem;   // Model OrderItem
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
{
    // Mengambil item cart untuk user yang sedang login
    $cartItems = Cart::where('user_id', Auth::id())->get();
    
    return view('cart.cart', compact('cartItems'));
    
}

    public function cart()
    {
    $cartItems = Cart::all(); // Ambil semua item dari cart
    $menus = Cart::all(); // Ambil semua menu, jika perlu
    return view('cart', compact('cartItems', 'menus')); // Kirimkan kedua variabel ke view
    }




    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'menu_id' => 'required|exists:menus,id',  // Memastikan menu_id ada di tabel menus
        'quantity' => 'required|integer|min:1',  // Memastikan quantity valid
    ]);

    // Ambil data menu berdasarkan menu_id
    $menu = Menu::findOrFail($validated['menu_id']);

    // Simpan data ke tabel cart
    Cart::create([
        'user_id' => auth()->id(),  // Ambil user yang sedang login
        'menu_id' => $validated['menu_id'],
        'nama' => $menu->nama,
        'harga' => $menu->harga,
        'Pesanan' => $validated['quantity'],  // Simpan quantity
        'foto' => $menu->foto,
    ]);

    return redirect()->route('cart.index');  // Kembali ke halaman cart atau halaman lain setelah order
}







    public function __construct()
    {
    $this->middleware('auth'); // Pastikan hanya pengguna yang login yang bisa mengakses
    }
    // Di dalam controller







    public function checkout(Request $request)
    {
        $menuIds = $request->input('menu_id');
        $quantities = $request->input('quantity');
        
        // Pastikan input menu_id dan quantity tidak kosong
        if ($menuIds && $quantities && count($menuIds) === count($quantities)) {
            foreach ($menuIds as $key => $menuId) {
                // Pastikan jumlah item di menuId dan quantity sama
                if (isset($quantities[$key])) {
                    Order::create([
                        'menu_id' => $menuId,
                        'quantity' => $quantities[$key],
                        'customer_name' => auth()->user()->name, // Nama customer
                    ]);
                }
            }
    
            return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
        } else {
            // Tangani jika input kosong atau jumlah data tidak sesuai
            return redirect()->back()->with('error', 'Menu atau Quantity tidak valid.');
        }
    }
    
   
    
    





    public function orderHistory()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.menu')->get();
        return view('order.history', compact('orders'));
    }

}