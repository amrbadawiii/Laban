<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\MeasurementUnitController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
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
    Route::resource('manufacture', ManufactureController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('quotations', QuotationController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::get('manufacture/stage/{id}', [ManufactureController::class, 'stage'])->name('manufacture.stage');
    Route::patch('/inbounds/{id}/confirm', [InboundController::class, 'confirm'])->name('inbounds.confirm');
    Route::post('/inbounds/store_items/{id}', [InboundController::class, 'storeItems'])->name('inbounds.storeItems');
    Route::get('/inbounds/create_inbound/{id}', [InboundController::class, 'createInbound'])->name('inbounds.createInbound');
    Route::delete('/inbounds/delete_item/{id}', [InboundController::class, 'deleteItem'])->name('inbounds.deleteItem');
    Route::post('/orders/store_items/{id}', [OrderController::class, 'storeItems'])->name('orders.storeItems');
    Route::get('/orders/create_order/{id}', [OrderController::class, 'createOrder'])->name('orders.createOrder');
    Route::delete('/orders/delete_item/{id}', [OrderController::class, 'deleteItem'])->name('orders.deleteItem');
    Route::patch('/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::patch('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/quotations/store_items/{id}', [QuotationController::class, 'storeItems'])->name('quotations.storeItems');
    Route::get('/quotations/create_quotation/{id}', [QuotationController::class, 'createQuotation'])->name('quotations.createQuotation');
    Route::delete('/quotations/delete_item/{id}', [QuotationController::class, 'deleteItem'])->name('quotations.deleteItem');
    Route::patch('/quotations/{id}/confirm', [QuotationController::class, 'confirm'])->name('quotations.confirm');
    Route::patch('/quotations/{id}/update-status', [QuotationController::class, 'updateStatus'])->name('quotations.updateStatus');
    Route::patch('/invoices/{id}/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');

    // Admin-Specific Routes
    Route::middleware('admin')->group(function () {
        // Add admin-specific routes here
    });

    // User-Specific Routes
    Route::middleware('user')->group(function () {
        // Add user-specific routes here
    });
});
