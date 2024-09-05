<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\ReportController;

// Auth Path
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Auth Path
    Route::post('/user/logout', [AuthController::class, 'logout']);

    // Product Path
    Route::get('/products/{divisa}', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'create'])->middleware('role:admin');
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('role:admin');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('role:admin');

    // Purchase Path
    Route::get('/purchases', [PurchaseController::class, 'index']);
    Route::post('/purchases', [PurchaseController::class, 'create']);
    Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->middleware('role:admin');
    Route::delete('/purchases/{id}', [PurchaseController::class, 'destroy'])->middleware('role:admin');

    // Report Path
    Route::post('/report', [ReportController::class, 'ReportByDate'])->middleware('role:admin');
        
});