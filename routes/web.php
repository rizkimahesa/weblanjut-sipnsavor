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

Route::get('/dashboard', function () {
    return view('home');
});

// Rute untuk Dashboard Admin dan Pengelolaan Menu
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/menus', [AdminController::class, 'index'])->name('menus.index');
    Route::resource('menus', MenuController::class); // CRUD Menu
});

// Rute untuk Order
Route::resource('orders', OrderController::class);
Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');

// Rute untuk Menu
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/menus/store', [MenuController::class, 'store'])->name('menus.store');
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
Route::get('/order', [MenuController::class, 'order'])->name('order');

// Rute untuk Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Rute untuk Kontak
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rute untuk Profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Rute untuk Autentikasi
Route::post('/login', [LoginController::class, 'login']);
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('register', [RegisteredController::class, 'create'])->name('register');
Route::post('register', [RegisteredController::class, 'register']);
