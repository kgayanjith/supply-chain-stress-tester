<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

   

    Route::prefix('/backend')->group(function () {
        
         Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        

        // customer Routes
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::post('/update/{customer}', [CustomerController::class, 'update'])->name('customer.update');
            Route::delete('/delete/{customer}', [CustomerController::class, 'destroy'])->name('customer.delete');
        });

        // Product category Routes
        Route::prefix('product-category')->group(function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('pcategory.index');
            Route::get('/create', [ProductCategoryController::class, 'create'])->name('pcategory.create');
            Route::post('/store', [ProductCategoryController::class, 'store'])->name('pcategory.store');
            Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('pcategory.edit');
            Route::post('/update/{pcategory}', [ProductCategoryController::class, 'update'])->name('pcategory.update');
            Route::delete('/delete/{pcategory}', [ProductCategoryController::class, 'destroy'])->name('pcategory.delete');
        });

        // Product Routes
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');
        });

        // Banner Routes
        Route::prefix('banner')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('banner.index');
            Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
            Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
            Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
            Route::post('/update/{banner}', [BannerController::class, 'update'])->name('banner.update');
            Route::delete('/delete/{banner}', [BannerController::class, 'destroy'])->name('banner.delete');
        });
    });
});
