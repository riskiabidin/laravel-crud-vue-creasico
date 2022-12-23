<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/user', App\Http\Controllers\API\UserController::class);
Route::resource('/category', App\Http\Controllers\API\CategoryController::class);
Route::resource('/supplier', App\Http\Controllers\API\SupplierController::class);
Route::resource('/produk', App\Http\Controllers\API\ProdukController::class);
Route::resource('/pembelian', App\Http\Controllers\API\PembelianController::class);
Route::resource('/member', App\Http\Controllers\API\MemberController::class);


// Route::get('/dashboard', [App\Http\Controllers\API\UserController::class, 'dashboard']);
