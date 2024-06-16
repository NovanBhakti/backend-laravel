<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceChargeController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
});
Route::get('/error', function () {
    return view('layouts.error');
});

Route::middleware('Role')->group(function () {
    Route::get('dashboard', function () {
        return view('pages.dashboard');
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('discount', DiscountController::class);
    Route::resource('tax', TaxController::class);
    Route::resource('service', ServiceChargeController::class);
    // Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/chart', [ChartController::class, 'getData']);
    Route::get('/sold-items', [ChartController::class, 'getSoldItemsData']);
    Route::get('/category-data', [ChartController::class, 'getCategoryData']);
});