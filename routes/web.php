<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

    Route::get('/users/create', [AuthController::class, 'showCreateUserForm'])->name('users.create');
    Route::post('/users/create', [AuthController::class, 'createUser'])->name('users.store');
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('measurementUnits', MeasurementUnitController::class);
    Route::resource('products', ProductController::class);
    Route::resource('inbounds', InboundController::class);
    Route::resource('stocks', StockController::class);
    Route::post('/inbounds/{id}/confirm', [InboundController::class, 'confirm'])->name('inbounds.confirm');
    // Admin-Specific Routes
    Route::middleware('admin')->group(function () {
        // Add admin-specific routes here
    });

    // User-Specific Routes
    Route::middleware('user')->group(function () {
        // Add user-specific routes here
    });
});
