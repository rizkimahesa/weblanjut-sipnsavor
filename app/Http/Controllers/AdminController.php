<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Menampilkan halaman menus untuk admin
        return view('menus.index');
    }
}

