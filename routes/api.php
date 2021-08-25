<?php

use App\Http\Controllers\Categories\ListCategoriesController;
use App\Http\Controllers\Products\GetProductsByCategoryController;
use App\Http\Controllers\Products\ListProductsController;
use App\Http\Controllers\Products\StoreProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('products')->group(function(){
    Route::get('/', ListProductsController::class);
    Route::get('/category/{category}', GetProductsByCategoryController::class);
    Route::post('/', StoreProductController::class);
});

Route::get('/categories', ListCategoriesController::class);
