<?php

use App\Http\Controllers\Api\AuthenticatedController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', 'getProducts');
    Route::get('/{productId}', 'getProduct');
});

Route::prefix('categories')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'getCategories');
});

// csrf
