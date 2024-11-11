<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Ambil user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Periksa apakah user ditemukan dan password cocok
    if ($user && $user->password === $request->password) {
        // Autentikasi berhasil
        Auth::login($user, $request->remember);
        session(['user_id' => $user->id]);
        // Cek role dan arahkan ke halaman yang sesuai
        if ($user->role === 'admin') {
            return redirect()->route('menus.index');  // Redirect ke halaman admin
        } else {
            return redirect()->route('dashboard');  // Redirect ke dashboard pengguna
        }
    }

    // Jika autentikasi gagal
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

}




