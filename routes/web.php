<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('orders', OrderController::class);
Route::resource('menus', MenuController::class);
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');
Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('dashboard');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/dashboard', [CartController::class, 'dashboard'])->name('dashboard');




