<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logoutAccount', [PageController::class, 'logoutAccount']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Payment Method
Route::get('/payment-method', [PaymentMethodController::class, 'paymentMethod']);

//Account
Route::get('/account', [AccountController::class, 'account']);

//Incoming Order
Route::get('/incoming-order', [OrderController::class, 'incomingOrder'])->name('incomingOrder');

//Accepted Order
Route::get('/accepted-order', [OrderController::class, 'acceptedOrder'])->name('acceptedOrder');