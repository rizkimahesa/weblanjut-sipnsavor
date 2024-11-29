<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\AuthController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman Dashboard (setelah login)
Route::middleware('auth')->get('/home', [DashboardController::class, 'index'])->name('dashboard');

// Rute untuk Admin: Pengelolaan Menu
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('menus', MenuController::class);  // CRUD Menu
});

// Rute untuk Profil Pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Rute untuk Cart (Keranjang Belanja)
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Rute untuk Order
Route::middleware(['auth'])->group(function () {
    Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');
    Route::resource('orders', OrderController::class);
});

// Rute untuk Kontak
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Rute untuk Registrasi
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredController::class, 'create'])->name('register');
    Route::post('register', [RegisteredController::class, 'register']);
});

// Rute untuk Login
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->get('/order', [OrderController::class, 'index'])->name('order');
Route::middleware('auth')->get('/cart', [OrderController::class, 'index'])->name('cart');

// Rute untuk Logout
Route::middleware('auth')->post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
});

//tambahan
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/konfirmasi', [OrderController::class, 'konfirmasi'])->name('menus.konfirmasi');
Route::get('/orders/view', [OrderController::class, 'view'])->name('menus.view');
Route::get('/orders/pesan', [OrderController::class, 'pesan'])->name('menus.pesan');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/menus/pesan', [MenuController::class, 'pesan'])->name('menus.pesan');

