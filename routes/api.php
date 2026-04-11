<?php

use App\Http\Controllers\Api\V1\BannerController;
use App\Http\Controllers\Api\V1\ProductCategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::get('/product-categories', [ProductCategoryController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/banners', [BannerController::class, 'index']);
    // Route::get('/ping', fn () => response()->json(['ok' => true]));
});