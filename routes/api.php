<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::resource('products', [ProductController::class]);
Route::group(['prefix' => 'product'], function() {
    Route::get('/all-product', [ProductController::class, 'allProduct']);
    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::post('/edit-product', [ProductController::class, 'editProduct']);
    Route::delete('/delete-product', [ProductController::class, 'deleteProduct']);
});

Route::group(['prefix' => 'category'], function() {
    Route::get('/all-category', [CategoryController::class, 'allCategory']);
    Route::post('/add-category', [CategoryController::class, 'addCategory']);
    Route::post('/edit-category', [CategoryController::class, 'editCategory']);
    Route::delete('/delete-category', [CategoryController::class, 'deleteCategory']);
});