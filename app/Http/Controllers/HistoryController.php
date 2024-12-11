<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HistoryController extends Controller
{
    public function index()
    {
         // Mendapatkan ID pengguna yang sedang login
         $userId = Auth::id(); // ID pengguna yang login

         // Mengambil pesanan hanya yang dimiliki oleh pengguna yang login
         $orders = Order::with('menu', 'user')
                         ->where('user_id', $userId) // Menampilkan pesanan berdasarkan user_id
                         ->get();
        return view('history', compact('orders'));
    }
    public function showAllOrders()
{
    // Mengambil seluruh data dari tabel orders beserta relasi
    $orders = Order::with('menu', 'user')->get();

    // Mengembalikan tampilan PesananUser.blade.php dengan data orders
    return view('menus.PesananUser', compact('orders'));
}

}
