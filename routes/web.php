<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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




