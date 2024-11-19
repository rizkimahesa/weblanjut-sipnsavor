<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman utama setelah login (Dashboard)
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rute untuk Dashboard Admin dan Pengelolaan Menu (hanya untuk Admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('menus', MenuController::class);  // CRUD Menu
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
});

// Rute untuk Profil Pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Rute untuk Cart (keranjang belanja)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Rute untuk pemesanan
Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');
Route::resource('orders', OrderController::class);

// Rute untuk halaman kontak
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::view('/contact', 'contact')->name('contact');

// Rute untuk Registrasi
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredController::class, 'create'])->name('register');
    Route::post('register', [RegisteredController::class, 'register']);
});

// Rute untuk login
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});

// Rute untuk logout
Route::middleware('auth')->post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute lain-lain (termasuk halaman yang bisa diakses oleh pengguna tanpa login)
Route::view('home', 'home')->name('home'); // Halaman utama jika pengguna belum login
// Tambahkan rute untuk halaman order
Route::get('/order', [OrderController::class, 'index'])->name('order');
// Rute untuk halaman keranjang belanja (cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart');
// Di web.php
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
