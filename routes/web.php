<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes Group with proper naming
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes
    Route::get('/login', [AdminController::class, 'create'])->name('login');
    Route::post('/login', [AdminController::class, 'store'])->name('login.submit');

    // Dashboard route with proper name
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Verify route
    Route::get('/verify', [AdminController::class, 'verify'])->name('verify');

    // Logout route
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});