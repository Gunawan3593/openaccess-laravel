<?php

use Illuminate\Http\Request;
use Modules\Product\Http\Controllers\ProductController;

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

// Route::middleware('auth:api')->get('/product', function (Request $request) {
//     return $request->user();
// });

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product/add', [ProductController::class, 'store']);
Route::put('/product/update/{id}', [ProductController::class, 'update']);
Route::get('/product/show/{id}', [ProductController::class, 'show']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);