<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('/products', \App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');
Route::apiResource('/categories', \App\Http\Controllers\Api\CategoryController::class)->middleware('auth:sanctum');
Route::post('/save-order', [\App\Http\Controllers\Api\OrderController::class, 'saveOrder'])->middleware('auth:sanctum');
Route::get('/orders', [\App\Http\Controllers\Api\OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/orders/{orderId}/items', [\App\Http\Controllers\Api\OrderController::class, 'getOrderItems'])->middleware('auth:sanctum');
Route::get('/orders-with-items', [\App\Http\Controllers\Api\OrderController::class, 'getOrdersWithItems'])->middleware('auth:sanctum');
Route::get('/discounts', [\App\Http\Controllers\Api\DiscountController::class, 'index'])->middleware('auth:sanctum');
Route::get('/taxes', [\App\Http\Controllers\Api\TaxController::class, 'index'])->middleware('auth:sanctum');
Route::get('/service-charges', [\App\Http\Controllers\Api\ServiceChargeController::class, 'index'])->middleware('auth:sanctum');