<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menangani request registrasi pengguna.
     */
    public function register(Request $request)
    {
        // Validasi data registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:8', // Tidak ada 'confirmed'
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => $request->password, // Enkripsi password
            'role' => 'user', // Menetapkan role sebagai 'user'
        ]);

        // Setelah registrasi sukses, arahkan ke halaman login
        return redirect()->route('login');
    }
}
