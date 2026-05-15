<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\Manager\ManagerRegisterController;
use App\Http\Controllers\Manager\ManagerLoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;



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


Route::get('/', [ShopController::class, 'index']);
Route::get('/dashboard',[UserController::class, 'index'])->middleware('verified');
Route::get('/search', [ShopController::class, 'search']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
Route::post('/done', [ShopController::class, 'done']);
Route::post('/favorite/{shop}', [ShopController::class, 'like'])->name('favorite');
Route::delete('/delete/{shop}', [ShopController::class, 'unlike'])->name('delete');
Route::prefix('mypage')->group(function () {
    Route::get('', [UserController::class, 'mypage']);
    Route::patch('update', [UserController::class, 'update']);
    Route::post('review', [UserController::class, 'review']);
    Route::delete('unreserve', [UserController::class, 'cancel']);
    Route::delete('/unfavorite', [UserController::class, 'delete']);
    Route::post('/reservation/qr/{id}',[UserController::class, 'generateQr'])->name('qrCode');
    Route::get('/reservation/qr/{id}/status',[UserController::class,'statusQr']);
});
Route::prefix('admin')->group(function(){
    Route::middleware('auth:admin')->group(function () {
        Route::get('', [AdminController::class, 'admin']);
    });
    Route::get('login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('login',[AdminLoginController::class, 'store']);
    Route::get('logout',[AdminLoginController::class, 'destroy']);
    Route::get('register', [AdminRegisterController::class, 'create'])->name('admin.register');
    Route::post('register', [AdminRegisterController::class, 'store']);
    Route::get('/lists',[AdminController::class,'list']);
    Route::get('mail/user',[MailController::class, 'MailUser']);
    Route::get('mail/shop', [MailController::class, 'MailShop']);
    Route::post('/mail/user',[MailController::class, 'sendUser']);
    Route::post('/mail/shop',[MailController::class, 'sendShop']);
});
Route::prefix('manager')->group(function(){
    Route::middleware('auth:manager')->group(function(){
        Route::get('',[ManagerController::class, 'manager']);
    });
    Route::get('login', [ManagerLoginController::class, 'create'])->name('manager.login');
    Route::post('login', [ManagerLoginController::class, 'store']);
    Route::post('register', [ManagerRegisterController::class, 'store']);
    Route::get('logout', [ManagerLoginController::class, 'destroy']);
    Route::get('/booking',[ManagerController::class,'booking']);
    Route::get('mail/admin',[MailController::class, 'sendUser']);
    Route::post('/shops',[ManagerController::class,'shopCreate']);
    Route::patch('shops/update',[ManagerController::class, 'shopUpdate']);
    Route::put('edit/{id}',[AdminController::class, 'ManagerUpdate'])->name('manager.edit');
    Route::post('price',[ManagerController::class,'savePrice'])->name('store.price');
    Route::get('/checkin',[ManagerController::class,'checkin'])->name('store.checkin');
    Route::post('/qr-checkin',[ManagerController::class,'QrScan'])->name('store.QrScan');
});
Route::prefix('payment')->group(function(){
    Route::get('/checkout/{reservation_id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/success', function(){
        return view('payment.success');
    })->name('payment.success');
    Route::get('/cancel', function () {
        return view('payment.cancel');
    })->name('payment.cancel');
});
Route::post('stripe/webhook',[WebhookController::class,'webhook']);

