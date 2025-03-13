<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Config;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])
        ->name('checkout.process');
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');
});

Route::get('/organizations', [OrganizationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('organizations.index');
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('product.show');

Route::post('/cart/add', [CartController::class, 'add'])
    ->middleware(['auth', 'verified'])
    ->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])
    ->middleware(['auth', 'verified'])
    ->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cart.index');

Route::get('/products', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('products.index');

require __DIR__ . '/auth.php';

Route::get('/{organization_name}', [OrganizationController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('organization.products');

Route::fallback(function () {
    return response()->view('errors.404', [
        'currentTime' => now()->format('Y-m-d H:i:s'),
        'currentUser' => \Illuminate\Support\Facades\Auth::user()?->name ?? 'Guest'
    ], 404);
});