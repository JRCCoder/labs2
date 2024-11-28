<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\StaffLoginController;
use App\Http\Controllers\PaymentStatusController;
use App\Http\Controllers\CatalogController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Product routes
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/choice', function () {
    return view('auth.choice');
})->name('choice');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
});
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/products', [App\Http\Controllers\ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [App\Http\Controllers\ProductController::class, 'adminCreate'])->name('admin.products.create');
    Route::post('/admin/products', [App\Http\Controllers\ProductController::class, 'adminStore'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'adminEdit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [App\Http\Controllers\ProductController::class, 'adminUpdate'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [App\Http\Controllers\ProductController::class, 'adminDestroy'])->name('admin.products.destroy');

    Route::get('/admin/users', [AdminController::class, 'userIndex'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
});

// admin dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');
// views/products/index
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
// sa cart ni dzaii para ma handle nya ang views duhhh
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('place.order');
// Para makita ang receipt
Route::get('/order/receipt/{order}', [CartController::class, 'showReceipt'])->name('order.receipt');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/my-orders', [OrderController::class, 'customerOrders'])->name('customer_orders');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/admin/orders/report', [OrderController::class, 'report'])->name('admin.orders.report');
});

Route::get('/admin/orders', [App\Http\Controllers\OrderController::class, 'adminIndex'])->name('admin.orders.index');
Route::get('/admin/orders/{order}', [App\Http\Controllers\OrderController::class, 'adminShow'])->name('admin.orders.show');

// Add this new route for viewing products
Route::get('/view-products', function () {
    return Auth::check() ? redirect()->route('products.index') : redirect()->route('login');
})->name('view.products');

require __DIR__.'/auth.php';

Route::post('/validate-voucher', [CartController::class, 'validateVoucher'])->name('validate.voucher');

Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class);
        // ... other admin routes
    });
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::patch('/admin/inventory/{product}', [InventoryController::class, 'updateStock'])->name('admin.inventory.update');
    Route::get('/admin/reports/inventory', [ReportController::class, 'inventoryReport'])->name('admin.reports.inventory');
    Route::get('/admin/reports/inventory/export', [ReportController::class, 'exportInventoryReport'])->name('admin.reports.inventory.export');
});

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

Route::middleware(['auth:staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});

Route::get('/staff/login', [StaffLoginController::class, 'showLoginForm'])->name('staff.login');
Route::post('/staff/login', [StaffLoginController::class, 'login'])->name('staff.login.submit');
Route::post('/staff/logout', [StaffLoginController::class, 'logout'])->name('staff.logout');

// Staff dashboard route
Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard')->middleware('auth:staff');

Route::post('/orders/{order}/feedback', [OrderController::class, 'submitFeedback'])->name('orders.feedback');
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/payment-status', [PaymentStatusController::class, 'index'])->name('admin.payment_status.index');
    Route::patch('/admin/payment-status/{order}', [PaymentStatusController::class, 'update'])->name('admin.payment_status.update');
    Route::post('/admin/payment-status/{order}/feedback', [PaymentStatusController::class, 'feedback'])->name('admin.payment_status.feedback');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/payments', [PaymentStatusController::class, 'index'])->name('admin.payments.index');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('admin/catalogs', CatalogController::class);
    Route::delete('/admin/catalogs/{catalog}', [CatalogController::class, 'destroy'])->name('admin.catalogs.destroy');
    Route::get('admin/catalogs/{catalog}/edit', [CatalogController::class, 'edit'])->name('admin.catalogs.edit');
    Route::put('admin/catalogs/{catalog}', [CatalogController::class, 'update'])->name('admin.catalogs.update');
});

Route::get('admin/catalogs/create', [CatalogController::class, 'create'])->name('admin.catalogs.create');
Route::post('admin/catalogs', [CatalogController::class, 'edit'])->name('admin.catalogs.edit');
Route::get('admin/catalogs', [CatalogController::class, 'index'])->name('admin.catalogs.index');
Route::post('admin/catalogs', [CatalogController::class, 'store'])->name('admin.catalogs.store');

Route::post('/admin/products/{id}/add-stock', [ProductController::class, 'addStock'])->name('admin.products.addStock');
Route::get('/admin/products/{id}/stock-history', [ProductController::class, 'showStockHistory'])->name('admin.products.stockHistory');

