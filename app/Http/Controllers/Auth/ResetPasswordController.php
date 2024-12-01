<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    // Menampilkan form reset password
    public function showResetForm()
    {
        return view('auth.reset-password');
    }

    // Mengecek email dan mengirimkan notifikasi jika ada
    public function checkEmail(Request $request)
{
    // Validasi email
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Jika email ditemukan, arahkan ke form reset password
    return redirect()->route('password.updateForm', ['email' => $request->email]);
}

    // Menampilkan form untuk mengubah password setelah email terverifikasi
    public function showPasswordForm($email)
    {
        return view('auth.reset-password', compact('email'));
    }

    // Menangani pengaturan ulang password
    public function resetPassword(Request $request)
{
    // Validasi password
    $request->validate([
        'password' => 'required|string|min:8',
    ]);

    // Temukan pengguna berdasarkan email
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // Update password tanpa hashing (jika tidak ingin menggunakan hash)
        $user->password = $request->password;
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah.');
    } else {
        return back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }
}


}