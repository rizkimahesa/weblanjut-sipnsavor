<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Fungsi untuk menampilkan form pendaftaran pengguna
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Ganti dengan view pendaftaran Anda
    }

    /**
     * Fungsi untuk menangani proses pendaftaran pengguna
     */
    public function register(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed', // Pastikan password terkonfirmasi
        ]);

        // Hash password sebelum menyimpannya
        $hashedPassword = Hash::make($request->password);

        // Simpan data pengguna ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);

        // Login pengguna setelah pendaftaran berhasil
        Auth::loginUsingId(User::latest()->first()->id);

        return redirect()->route('dashboard'); // Arahkan ke dashboard atau halaman lain setelah berhasil login
    }

    /**
     * Fungsi untuk menampilkan form login pengguna
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ganti dengan view login Anda
    }

    /**
     * Fungsi untuk menangani proses login pengguna
     */
    public function login(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard'); // Arahkan ke dashboard jika login berhasil
        }

        return back()->withErrors(['email' => 'Email atau password salah.']); // Tampilkan error jika login gagal
    }

    /**
     * Fungsi untuk menangani logout pengguna
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login'); // Arahkan ke halaman login setelah logout
    }
    public function showUsers()
    {
        $users = User::all();  // Ambil semua pengguna dari database
        return view('auth.login', compact('users'));  // Kirim data $users ke view
    }
}
