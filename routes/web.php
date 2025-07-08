<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VnPayController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/login',[Authcontroller::class,'login'])->name('login');
Route::post('/login',[Authcontroller::class,'postLogin'])->name('postLogin');
Route::get('/register',[Authcontroller::class,'register'])->name('register');
Route::post('/register',[Authcontroller::class,'postRegister'])->name('postRegister');
Route::middleware(['auth'])->group(function (){
    Route::post('/update-password', [Authcontroller::class, 'updatePassword'])->name('password.update');
    Route::post('/logout', [Authcontroller::class, 'logout'])->name('logout');
    Route::get('/order',[HomeController::class,'order'])->name('order');
    Route::post('/order',[HomeController::class,'postOrder'])->name('postOrder');
    Route::get('/payment',[HomeController::class,'payment'])->name('payment');
    Route::get('/profile',[HomeController::class,'profile'])->name('profile');

    Route::get('/vnpay/payment', [VnPayController::class, 'createPayment'])->name('vnpay.payment');
    Route::get('/vnpay/return', [VnPayController::class, 'handleReturn'])->name('vnpay.return');

});
