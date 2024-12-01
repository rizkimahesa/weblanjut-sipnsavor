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
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\ResetPasswordController;


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

// Menggunakan middleware auth untuk checkout dan order history
Route::middleware(['auth'])->group(function () {
    // Route untuk checkout cart
    Route::post('/cart/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
    
    // Route untuk melihat riwayat order
    Route::get('/order/history', [OrderController::class, 'orderHistory'])->name('order.history');
});

// Menggunakan middleware auth dan admin untuk admin orders
Route::middleware(['auth', 'admin'])->group(function () {
    // Route untuk melihat semua pesanan admin
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    
    // Route untuk mengonfirmasi pesanan oleh admin
    Route::post('/admin/orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');
});

// Route untuk halaman history
Route::get('/history', [HistoryController::class, 'index'])->name('history');

// Route untuk melihat daftar orders (bukan admin)
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Route untuk membuat pesanan baru
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Route untuk konfirmasi pesanan (admin)
Route::prefix('admin/orders')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/confirm/{orderId}', [AdminOrderController::class, 'confirmOrder'])->name('orders.confirm');
});


Route::middleware(['auth'])->group(function () {
    // Rute untuk menampilkan form checkout (jika diperlukan)
    Route::get('/cart/checkout', [OrderController::class, 'checkoutForm'])->name('cart.checkout.form');

    // Rute untuk menangani proses checkout
    Route::post('/cart/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');

    // Rute untuk menampilkan riwayat pemesanan
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});

// Rute tambahan untuk admin (jika ada halaman detail untuk order)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});
Route::middleware('auth')->get('/history', [HistoryController::class, 'index'])->name('history');
Route::post('/cart/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
Route::get('/admin/orders/konfirmasi', [AdminOrderController::class, 'konfirmasi'])->name('admin.orders.konfirmasi');

// Konfirmasi pesanan dari admin
Route::get('admin/orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');


// user membatalkan pesanan
Route::get('/user/pesanan', [OrderController::class, 'userPesanan'])->name('user.pesanan');
Route::post('/user/pesanan/{order}/cancel', [OrderController::class, 'cancelPesanan'])->name('user.pesanan.cancel');
Route::post('/pesanan/{id}/cancel', [OrderController::class, 'cancelPesanan'])->name('user.pesanan.cancel');
Route::get('/payment/process/{order_id}/{amount}', [PaymentController::class, 'process'])->name('payment.process');

// contact
Route::middleware('auth', 'admin')->group(function() {
    Route::get('/admin/pesan', [AdminController::class, 'showMessages'])->name('admin.pesan');
});
// routes/web.php

Route::get('/pesan', function () {
    return view('menus.pesan');  // Arahkan ke views/menus/pesan.blade.php
})->name('pesan.index');
Route::get('/pesan', [ContactController::class, 'index'])->name('pesan.index');
Route::delete('/pesan/{id}', [ContactController::class, 'destroy'])->name('pesan.destroy');

Route::delete('/pesan/{id}', [ContactController::class, 'destroy'])
    ->name('pesan.destroy')
    ->middleware('admin');

    Route::get('/reset-password', function () {
        return view('auth.reset-password');
    })->name('password.reset');
    
    Route::post('/check-email', [ResetPasswordController::class, 'checkEmail'])->name('password.checkEmail');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    
    
Route::get('/reset-password/{email}', [ResetPasswordController::class, 'showPasswordForm'])->name('password.updateForm'); // Rute baru untuk form reset password
Route::get('reset-password/{email}', [ResetPasswordController::class, 'showPasswordForm'])->name('password.updateForm');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');

Route::post('check-email', [ResetPasswordController::class, 'checkEmail'])->name('password.checkEmail');
Route::get('reset-password/{email}', [ResetPasswordController::class, 'showPasswordForm'])->name('password.updateForm');
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');



   