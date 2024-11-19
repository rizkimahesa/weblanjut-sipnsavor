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
use Illuminate\Support\Facades\Auth;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::get('/dashboard', function () {
    return view('home');
=======
// Rute Login dan Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Rute untuk Dashboard User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
>>>>>>> login
});

// Rute untuk Dashboard Admin dan Pengelolaan Menu
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/menus', [AdminController::class, 'index'])->name('menus.index');
    Route::resource('menus', MenuController::class);  // CRUD Menu
});

// Rute lain
Route::resource('orders', OrderController::class);
<<<<<<< HEAD
Route::resource('menus', MenuController::class);
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');
Route::get('/order', [MenuController::class, 'order'])->name('order');
=======
>>>>>>> login
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
<<<<<<< HEAD
Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/menus/store', [MenuController::class, 'store'])->name('menus.store');

Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');    
=======
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);


// Rute untuk profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
});

// routes/web.php
Route::post('/login', [LoginController::class, 'login']);
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('register', [RegisteredController::class, 'create'])->name('register');
Route::post('register', [RegisteredController::class, 'register']);
>>>>>>> login
