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

    
}

