<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
{
    // Mengambil semua pesanan (baik yang pending maupun yang sudah dikonfirmasi)
    $orders = Order::with('menu', 'user') // Pastikan relasi menu dan user dimuat
        ->orderBy('status') // Urutkan berdasarkan status
        ->get();

    return view('menus.konfirmasi', compact('orders'));
}


    public function confirm($id)
    {
        // Ambil pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Periksa apakah pesanan masih berstatus pending
        if ($order->status == 'pending') {
            // Ubah status menjadi confirmed
            $order->status = 'confirmed';
            $order->save();

            // Mengirimkan pesan sukses menggunakan sesi flash
            return redirect()->route('admin.orders.konfirmasi')->with('success', 'Pesanan berhasil dikonfirmasi!');
        }

        // Jika status bukan pending, beri pesan error
        return redirect()->route('admin.orders.konfirmasi')->with('error', 'Pesanan sudah dikonfirmasi atau tidak ditemukan.');
    }
    
    public function konfirmasi()
{
    // Ambil semua pesanan dengan status 'pending'
    $orders = Order::where('status', 'pending')->get();

    // Kirim data pesanan ke view
    return view('menus.konfirmasi', compact('orders'));
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

