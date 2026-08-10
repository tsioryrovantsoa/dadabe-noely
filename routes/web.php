<?php

use App\Http\Controllers\Auth\AdminSessionController;
use App\Http\Controllers\Auth\ChildSessionController;
use App\Http\Controllers\Auth\RegisteredChildController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\ValidateWishlistController;
use App\Http\Controllers\WishController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::get('gifts', [GiftController::class, 'index'])->name('gifts.index');
Route::get('gifts/{gift}', [GiftController::class, 'show'])->name('gifts.show');

Route::middleware('guest:child')->group(function () {
    Route::get('register', [RegisteredChildController::class, 'create'])->name('register');
    Route::post('register', [RegisteredChildController::class, 'store']);

    Route::get('login', [ChildSessionController::class, 'create'])->name('login');
    Route::post('login', [ChildSessionController::class, 'store'])->middleware('throttle:6,1');
});

Route::middleware('auth.child')->group(function () {
    Route::post('logout', [ChildSessionController::class, 'destroy'])->name('logout');

    Route::get('wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::post('wishes', [WishController::class, 'store'])->name('wishes.store');
    Route::patch('wishes/{wish}', [WishController::class, 'update'])->name('wishes.update');
    Route::delete('wishes/{wish}', [WishController::class, 'destroy'])->name('wishes.destroy');
    Route::post('wishlist/validate', ValidateWishlistController::class)->name('wishlist.validate');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminSessionController::class, 'create'])->name('login');
        Route::post('login', [AdminSessionController::class, 'store'])->middleware('throttle:6,1');
    });

    Route::middleware('auth.admin')->group(function () {
        Route::inertia('/', 'Admin/Dashboard')->name('dashboard');
        Route::post('logout', [AdminSessionController::class, 'destroy'])->name('logout');
    });
});
