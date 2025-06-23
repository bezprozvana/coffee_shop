<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('catalog')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('catalog');
    Route::get('/category/{category}', [CatalogController::class, 'showCategory'])->name('catalog.category');
    Route::get('/product/{product}', [CatalogController::class, 'showProduct'])->name('catalog.show');
    Route::get('/search', [CatalogController::class, 'search'])->name('catalog.search');
});

Route::prefix('wishlist')->middleware('auth')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});

Route::prefix('comparison')->middleware('auth')->group(function () {
    Route::get('/', [ComparisonController::class, 'index'])->name('comparison.index');
    Route::post('/add/{product}', [ComparisonController::class, 'add'])->name('comparison.add');
    Route::delete('/comparison/{product}', [ComparisonController::class, 'remove'])->name('comparison.remove');
    Route::delete('/comparison', [ComparisonController::class, 'clear'])->name('comparison.clear');
});

Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/increment/{cart}', [CartController::class, 'increment'])->name('cart.increment');
    Route::post('/decrement/{cart}', [CartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return "Dashboard ще не реалізовано.";
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');

    Route::prefix('profile/addresses')->group(function () {
        Route::get('/', [ProfileController::class, 'addresses'])->name('profile.addresses');
        Route::get('/create', [ProfileController::class, 'createAddress'])->name('profile.addresses.create');
        Route::post('/', [ProfileController::class, 'storeAddress'])->name('profile.addresses.store');
        Route::get('/{address}/edit', [ProfileController::class, 'editAddress'])->name('profile.addresses.edit');
        Route::put('/{address}', [ProfileController::class, 'updateAddress'])->name('profile.addresses.update');
        Route::delete('/{address}', [ProfileController::class, 'destroyAddress'])->name('profile.addresses.destroy');
    });
    
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::resource('brands', BrandController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class);
        Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
        Route::resource('users', UserController::class)->only(['index', 'show', 'destroy']);
    });

require __DIR__.'/auth.php';