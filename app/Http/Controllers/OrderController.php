<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu; // Import the Menu model
use Illuminate\Http\Request;

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
        $orders = Order::with('menu')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
        ]);

        // Create a new order
        Order::create([
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'customer_name' => $request->customer_name,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

}

