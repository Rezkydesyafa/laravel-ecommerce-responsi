<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Home routes (Customer)
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{product}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::resource('cart', App\Http\Controllers\CartController::class)->only(['index', 'store', 'update', 'destroy']);

    // Checkout Routes
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/checkout/success', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/payment/{transaction}', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');

    // Transaction History
    Route::get('/history', [App\Http\Controllers\TransactionController::class, 'history'])->name('transaction.history');
});

Route::post('/midtrans/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans.callback');

require __DIR__.'/auth.php';    
