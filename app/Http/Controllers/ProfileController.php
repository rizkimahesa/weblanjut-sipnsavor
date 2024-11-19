<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan halaman edit profil
    public function edit()
    {
        return view('profile.edit'); // Pastikan ada view profile/edit.blade.php
    }
}
