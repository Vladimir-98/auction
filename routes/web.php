<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    abort(404);
});

Route::prefix('/telegram/')->group(function () {

    Route::get('auction', function () {
        return view('auction');
    })->name('telegram.auction');

    Route::get('orders', fn() => view('auction'));
    Route::get('payment', fn() => view('auction'));
    Route::get('cart', fn() => view('auction'));
});

