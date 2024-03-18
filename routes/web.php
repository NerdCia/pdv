<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CreateSaleController;
use App\Http\Controllers\UserController;
use App\Models\RoleUser;
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

  Route::group([
    'prefix' => '/',
    'as' => 'components.'
  ], function () {
    Route::get('', [DashboardController::class, 'index'])
      ->name('dashboard')
      ->middleware(['authorization.all']);
    Route::get('products/{category?}', [ProductController::class, 'index'])
      ->name('products')
      ->middleware(['authorization.products']);
    Route::get('edit_product/{id}', [ProductController::class, 'edit'])
      ->name('edit_product')
      ->middleware(['authorization.products']);
    Route::get('create_product', [ProductController::class, 'create'])
      ->name('create_product')
      ->middleware(['authorization.products']);
    Route::get('create_category', [CategoryController::class, 'create'])
      ->name('create_category')
      ->middleware(['authorization.products']);
    Route::get('sales', [SaleController::class, 'index'])
      ->name('sales')
      ->middleware(['authorization.sales']);
    Route::get('edit_sale/{id}', [SaleController::class, 'edit'])
      ->name('edit_sale')
      ->middleware(['authorization.sales']);
    Route::get('create_sale', [CreateSaleController::class, 'index'])
      ->name('create_sale')
      ->middleware(['authorization.sales']);
    Route::get('configurations', [ConfigurationController::class, 'index'])
      ->name('configurations')
      ->middleware(['authorization.all']);
  });

  Route::middleware(['authorization.all'])->group(function () {
    Route::group([
      'prefix' => '/',
      'as' => 'configurations.'
    ], function () {
      Route::post('update_configurations', [ConfigurationController::class, 'update'])
        ->name('update');
    });

    Route::group([
      'prefix' => '/',
      'as' => 'user.'
    ], function () {
      Route::post('update_user/{id}', [UserController::class, 'update'])
        ->name('update');
      Route::post('update_role_user/{id}', [RoleUserController::class, 'update'])
        ->name('role.update');
    });
  });

  Route::middleware(['authorization.sales'])->group(function () {
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
  });

  Route::middleware(['authorization.products'])->group(function () {
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
});

Route::resource('users', UserController::class);

Route::view('/login', 'form.login')->name('form.login');
Route::post('/auth', [LoginController::class, 'auth'])->name('form.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('form.logout');
Route::get('/register', [LoginController::class, 'create'])->name('form.register');