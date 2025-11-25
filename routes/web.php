<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes Group with proper naming
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication routes
    Route::get('/login', [AdminController::class, 'create'])->name('login');
    Route::post('/login', [AdminController::class, 'store'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Profile & Settings
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('/password', [AdminController::class, 'editPassword'])->name('password.edit');
    Route::post('/password', [AdminController::class, 'updatePassword'])->name('password.update');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

    // Admin Management
    Route::get('/admins', [AdminController::class, 'list'])->name('admins.list');
    Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admins.show');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    Route::post('/admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.status');

    // AJAX endpoints
    Route::get('/admins-search', [AdminController::class, 'search'])->name('admins.search');
    Route::get('/stats', [AdminController::class, 'getStats'])->name('stats');

    // Verification
    Route::get('/verify', [AdminController::class, 'verify'])->name('verify');
});
