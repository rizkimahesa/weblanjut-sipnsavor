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
    public function showMessages()
    {
        // Ambil semua pesan yang ada
        $pesan = Pesan::all(); // Bisa ditambahin paginasi jika banyak data

        return view('admin.pesan', compact('pesan'));
    }
}

