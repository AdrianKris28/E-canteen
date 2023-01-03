<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/menuSeller', [PageController::class, 'menuSeller']);
Route::get('/menuDetailSeller', [PageController::class, 'menuDetailSeller']);
Route::get('/menuDetailBuyer', [PageController::class, 'menuDetailBuyer']);
Route::post('/editMenu', [PageController::class, 'editMenu']);

Route::get('/addNewProductSeller', [PageController::class, 'addNewProductSeller']);
Route::post('/addProduct', [PageController::class, 'addProduct']);

Route::get('/salesSeller', [PageController::class, 'salesSeller']);
Route::get('/transactionHistorySeller', [PageController::class, 'transactionHistorySeller']);
Route::get('/transactionHistoryDetailSeller', [PageController::class, 'transactionHistoryDetailSeller']);
Route::get('/transactionHistoryBuyer', [PageController::class, 'transactionHistoryBuyer']);
Route::get('/transactionHistoryDetailBuyer', [PageController::class, 'transactionHistoryDetailBuyer']);

Route::post('/logoutAccount', [PageController::class, 'logoutAccount']);
Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Inside Outlet
Route::get('/insideOutlet', [PageController::class, 'insideOutlet']);

//Payment Method
Route::get('/payment-method', [PaymentMethodController::class, 'paymentMethod']);

//Account
Route::get('/account', [AccountController::class, 'account']);

//Incoming Order
Route::get('/incoming-order', [OrderController::class, 'incomingOrder'])->name('incomingOrder');

//Accepted Order
Route::get('/accepted-order', [OrderController::class, 'acceptedOrder'])->name('acceptedOrder');

//Cart
Route::get('/cartBuyer', [PageController::class, 'cartBuyer']);