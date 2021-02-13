<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::put('/products/bulk-update', [ProductController::class, 'bulkUpdate'])->name('products.bulk-update');
Route::get('/products/seed', function(){
    return response(Product::factory()->count(20)->create());
});
Route::resource('/products', ProductController::class);

// Route::middleware('auth:api')->group(function () {
//     Route::put('/products/bulk-update', [ProductController::class, 'bulkUpdate'])->name('products.bulk-update');
//     Route::resource('/products', ProductController::class);
// });


