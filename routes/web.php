<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('menus', MenuController::class);
Route::resource('orders', OrderController::class);
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
Route::get('orders/create/{menuId?}', [OrderController::class, 'create'])->name('orders.create');
Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('dashboard');

//tambahan
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/konfirmasi', [OrderController::class, 'konfirmasi'])->name('menus.konfirmasi');
Route::get('/orders/view', [OrderController::class, 'view'])->name('menus.view');
Route::get('/orders/pesan', [OrderController::class, 'pesan'])->name('menus.pesan');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/menus/pesan', [MenuController::class, 'pesan'])->name('menus.pesan');




