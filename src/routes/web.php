<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShopController::class,'index']);
Route::get('/search', [ShopController::class, 'search']);
Route::get('/menu', [AuthController::class,'menu']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
Route::post('/done',[ShopController::class,'done']);
Route::post('/favorite/{shop}', [ShopController::class, 'like'])->name('favorite');
Route::delete('/delete/{shop}', [ShopController::class, 'unlike'])->name('delete');
Route::get('/mypage',[UserController::class, 'mypage']);
Route::delete('/mypage/unreserve', [UserController::class, 'cancel']);
Route::delete('/mypage/unfavorite', [UserController::class, 'delete']);