<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
Route::apiResource('category', CategoryController::class)->parameters(['category' => 'id']);
Route::apiResource('product', ProductController::class)->parameters(['product' => 'id']);

//  Inflexible
// Route::resources([
//     'category' => CategoryController::class,
// ]);

// Route::
