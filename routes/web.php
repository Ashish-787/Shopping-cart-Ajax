<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginSave');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerStore');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {


    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'Create'])->name('createProduct');
    Route::post('/productstore', [ProductController::class, 'store']);

    
    Route::get('/productView', [ProductController::class, 'ProductView'])->name('productView');
    Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/cart', [ProductController::class, 'cartView'])->name('admin.cart');
    Route::post('/update-cart-quantity', [ProductController::class, 'updateQuantity'])->name('update-cart-quantity');

    Route::post('/remove-cart', [ProductController::class, 'removeItem']);



    Route::get('/checkout', [ProductController::class, 'indexcheckout'])->name('checkout');
    Route::post('/place-order', [ProductController::class, 'placeOrder'])->name('place.order');

    Route::get('/order-success', function () {
        return view('Admin.Thankyou');  })->name('order.success');

});
