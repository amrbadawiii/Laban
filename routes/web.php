<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/unauthorized', function () {
    return view('errors.403'); // Display a custom 403 page
})->name('unauthorized');



// Protected Routes
Route::middleware(['auth', 'setlocale'])->group(function () {
    Route::get('/language/{locale}', [LanguageController::class, 'setLanguage'])->name('language.set');
    // Shared Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin-Specific Routes
    Route::middleware('admin')->group(function () {
        Route::get('/users/create', [AuthController::class, 'showCreateUserForm'])->name('users.create');
        Route::post('/users/create', [AuthController::class, 'createUser'])->name('users.store');
        Route::resource('warehouses', WarehouseController::class);
    });

    // User-Specific Routes
    Route::middleware('user')->group(function () {
        // Add user-specific routes here
    });
});
