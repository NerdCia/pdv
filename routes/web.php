<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CreateSaleController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {

  Route::middleware(['authorization.products'])->group(function () {
    Route::group([
      'prefix' => '/',
      'as' => 'components.'
    ], function () {
      Route::get('', [DashboardController::class, 'index'])
        ->name('dashboard');
      Route::get('products/{category?}', [ProductController::class, 'index'])
        ->name('products');
      Route::get('edit_product/{id}', [ProductController::class, 'edit'])
        ->name('edit_product');
      Route::get('create_product', [ProductController::class, 'create'])
        ->name('create_product');
      Route::get('create_category', [CategoryController::class, 'create'])
        ->name('create_category');
      Route::get('sales', [SaleController::class, 'index'])
        ->name('sales');
      Route::get('edit_sale/{id}', [SaleController::class, 'edit'])
        ->name('edit_sale');
      Route::get('create_sale', [CreateSaleController::class, 'index'])
        ->name('create_sale');
      Route::get('confugurations', [ConfigurationController::class, 'index'])
        ->name('configurations');
    });
  });

  Route::group([
    'prefix' => '/',
    'as' => 'sale.product.'
  ], function () {
    Route::post('sale_add_product', [CreateSaleController::class, 'saleAddProduct'])
      ->name('add');
    Route::post('sale_update_product', [CreateSaleController::class, 'saleUpdateProduct'])
      ->name('update');
    Route::post('sale_remove_product', [CreateSaleController::class, 'saleRemoveProduct'])
      ->name('remove');
  });

  Route::group([
    'prefix' => '/',
    'as' => 'sale.'
  ], function () {
    Route::post('store_sale', [SaleController::class, 'store'])
      ->name('store');
    Route::post('update_sale/{id}', [SaleController::class, 'update'])
      ->name('update');
    Route::delete('destroy_sale/{id}', [SaleController::class, 'destroy'])
      ->name('destroy');
  });

  Route::group([
    'prefix' => '/',
    'as' => 'category.'
  ], function () {
    Route::post('store_category', [CategoryController::class, 'store'])
      ->name('store');
    Route::post('update_category/{id}', [CategoryController::class, 'update'])
      ->name('update');
    Route::delete('destroy_category/{id}', [CategoryController::class, 'destroy'])
      ->name('destroy');
  });

  Route::group([
    'prefix' => '/',
    'as' => 'product.'
  ], function () {
    Route::post('store_product', [ProductController::class, 'store'])
      ->name('store');
    Route::post('update_product/{id}', [ProductController::class, 'update'])
      ->name('update');
    Route::delete('destroy_product/{id}', [ProductController::class, 'destroy'])
      ->name('destroy');
  });
});

Route::resource('users', UserController::class);

Route::view('/login', 'form.login')->name('form.login');
Route::post('/auth', [LoginController::class, 'auth'])->name('form.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('form.logout');
Route::get('/register', [LoginController::class, 'create'])->name('form.register');