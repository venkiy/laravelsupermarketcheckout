<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('add-to-cart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addcart');
Route::post('clear-cart', [App\Http\Controllers\CartController::class, 'ClearCart'])->name('clearcart');
