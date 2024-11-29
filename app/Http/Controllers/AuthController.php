<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses login
    public function login(Request $request)
{
    // Validasi data
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Mencari pengguna berdasarkan email
    $user = User::where('email', $credentials['email'])->first();

    // Periksa apakah pengguna ditemukan dan password cocok (langsung dengan string, tanpa hash)
    if ($user && $user->password === $credentials['password']) {
        // Jika login berhasil, lakukan autentikasi
        Auth::login($user);
    
        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('menus.index'); // Halaman menu untuk admin
        }
    
        return redirect()->route('dashboard'); // Halaman dashboard untuk user biasa
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}

    // Proses register
    public function register(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login setelah registrasi
        Auth::login($user);

        return redirect('/dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

