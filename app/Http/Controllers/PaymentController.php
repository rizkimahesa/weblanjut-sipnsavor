<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process($order_id, $amount)
{
    // Logika pemrosesan pembayaran
    return view('payment.process', compact('order_id', 'amount'));
}
public function showPaymentPage()
{
    $cartItems = Cart::where('user_id', auth()->id())->get(); // Contoh query
    $paymentUrl = 'https://contoh-pembayaran.com'; // Tambahkan URL pembayaran jika diperlukan
    
    return view('paymert.payment', compact('cartItems', 'paymentUrl'));
}

    
}

