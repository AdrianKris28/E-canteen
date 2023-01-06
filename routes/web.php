<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
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

Route::get('/', [PageController::class, 'homepage']);
// Route::get('/{id}', [PageController::class, 'home']);

Route::get('/menuSeller', [PageController::class, 'menuSeller']);
Route::get('/menuDetailSeller/{id}', [PageController::class, 'menuDetailSeller']);

Route::get('/searchOutlet', [PageController::class, 'searchOutlet']);
Route::get('/searchProduct', [PageController::class, 'searchProduct']);

Route::get('/deleteMenu/{id}', [PageController::class, 'deleteMenu']);

Route::get('/menuDetailBuyer', [PageController::class, 'menuDetailBuyer']);
Route::post('/editMenu', [PageController::class, 'editMenu']);

Route::get('/addNewProductSeller', [PageController::class, 'addNewProductSeller']);
Route::post('/addProduct', [PageController::class, 'addProduct']);

Route::get('/salesSeller', [PageController::class, 'salesSeller']);
Route::get('/transactionHistorySeller', [PageController::class, 'transactionHistorySeller']);
Route::get('/transactionHistoryDetailSeller', [PageController::class, 'transactionHistoryDetailSeller']);
Route::get('/transactionHistoryBuyer', [PageController::class, 'transactionHistoryBuyer'])->name('transactionHistory');
Route::get('/transactionHistoryDetailBuyer', [PageController::class, 'transactionHistoryDetailBuyer']);

Route::post('/logoutAccount', [PageController::class, 'logoutAccount']);
Auth::routes();

//Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Inside Outlet
Route::get('/insideOutlet/{id}', [PageController::class, 'insideOutlet']);

//Payment Method
Route::get('/payment-method', [PaymentMethodController::class, 'paymentMethod'])->name('paymentMethod');

//Account
Route::get('/account', [AccountController::class, 'account'])->name('account');
Route::post('/editProfile', [AccountController::class, 'editProfile']);

//Incoming Order
Route::get('/incoming-order', [OrderController::class, 'incomingOrder'])->name('incomingOrder');

//Accepted Order
Route::get('/accepted-order', [OrderController::class, 'acceptedOrder'])->name('acceptedOrder');

//Cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
