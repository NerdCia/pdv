<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CreateSaleController;
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

Route::group([
  'prefix' => '/',
  'as' => 'components.'
], function () {
  Route::get('', [DashboardController::class, 'index'])
    ->name('dashboard');
  Route::get('products/{category?}', [ProductController::class, 'index'])
    ->name('products');
  Route::get('product/{id}', [ProductController::class, 'edit'])
    ->name('product');
  Route::get('create_product', [ProductController::class, 'create'])
    ->name('create_product');
  Route::get('create_category', [CategoryController::class, 'create'])
    ->name('create_category');
  Route::get('sales', [SaleController::class, 'index'])
    ->name('sales');
  Route::get('create_sale', [CreateSaleController::class, 'index'])
    ->name('create_sale');
});

Route::group([
  'prefix' => '/',
  'as' => 'sale.'
], function () {
  Route::post('sale_add_product', [CreateSaleController::class, 'saleAddProduct'])
    ->name('add.product');
  Route::post('sale_update_product', [CreateSaleController::class, 'saleUpdateProduct'])
    ->name('update.product');
  Route::post('sale_remove_product', [CreateSaleController::class, 'saleRemoveProduct'])
    ->name('remove.product');
});