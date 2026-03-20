<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TicketController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/coupons', [CouponController::class, 'index'])->name('coupons');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/stores', [StoreController::class, 'index'])->name('stores');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'doRegister']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::post('/profile', [AuthController::class, 'doUpdateProfile'])->name('profile.update');

// Store Setup Route for merchants
Route::middleware(['auth'])->group(function () {
    Route::get('/store/setup', [StoreController::class, 'setup'])->name('store.setup');
    Route::post('/store/setup', [StoreController::class, 'storeSetup']);
});

// Merchant Dashboard
Route::middleware(['auth'])->prefix('merchant')->group(function () {
    Route::get('/dashboard', [StoreController::class, 'merchantDashboard'])->name('merchant.dashboard');
});

Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
Route::resource('tickets', TicketController::class);