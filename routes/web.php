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
Route::get('/products/{category?}', [ProductController::class, 'index'])->name('components.products');
Route::get('/sales', [SaleController::class, 'index'])->name('components.sales');
Route::get('/create_sale/{product?}', [SaleController::class, 'show'])->name('components.create_sale');
Route::post('/update_sale', [SaleController::class, 'add'])->name('components.update_sale');
Route::post('/sale_update_product', [SaleController::class, 'saleUpdateProduct'])->name('sale.update.product');
Route::post('/sale_remove_product', [SaleController::class, 'saleRemoveProduct'])->name('sale.remove.product');