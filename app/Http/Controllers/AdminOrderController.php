<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu', 'user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        $order = Order::findOrFail($orderId); // Cari order berdasarkan ID

        // Pastikan pesanan belum dikonfirmasi
        if ($order->status != 'confirmed') {
            $order->status = 'confirmed'; // Ubah status pesanan menjadi 'confirmed'
            $order->save(); // Simpan perubahan
        }

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dikonfirmasi');
    }
    
    public function konfirmasi()
    {
        // Ambil semua pesanan dengan relasi items, menu, dan user
        $orders = Order::with('items.menu', 'user')->get();
        return view('menus.konfirmasi', compact('orders')); // Kirim data ke view
    }


    public function confirmOrder($orderId)
    {
        // Find the order by ID
        $order = Order::findOrFail($orderId);
        
        // Update the status to 'confirmed'
        $order->status = 'confirmed';
        $order->save();

        // Redirect back with a success message
        return redirect()->route('orders.index')->with('success', 'Order has been confirmed.');
    }


}

