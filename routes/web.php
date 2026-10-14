<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/productos', [HomeController::class, 'catalog'])->name('products.index');
Route::get('/productos/{product}', [HomeController::class, 'show'])->name('products.show');
Route::get('/carrito', [HomeController::class, 'cart'])->name('cart.index');
