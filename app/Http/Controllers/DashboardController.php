<?php

namespace App\Http\Controllers;

use App\Models\Menu;  // Make sure Menu model is imported
use Illuminate\Http\Request;
use App\Models\Cart;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve all menu items from the Menu model
        $menus = Menu::all();  // Get all menus
        
        // Retrieve all cart items for the logged-in user
        $cartItems = Cart::where('user_id', auth()->id())->get();

        // Pass both $menus and $cartItems variables to the view
        return view('dashboard', compact('menus', 'cartItems'));
    }
}
