<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->name('components.dashboard');
Route::get('/products', [ProductController::class, 'index'])->name('components.products');
Route::get('/sales', [SaleController::class, 'index'])->name('components.sales');
