<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HistoryTransaction;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Redirect;
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
    return Redirect::route('login');
});

Route::get('/dashboard', [LandingPageController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'Admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::get('/create', [ProductController::class, 'createProducts'])->name('create.products');

    Route::post('/addProducts', [ProductController::class, 'addProducts'])->name('product.submit');
    Route::post('/deleteProduct', [ProductController::class, 'deleteProduct'])->name('product.delete');
    Route::post('/updateProduct', [ProductController::class, 'updateProduct'])->name('product.update');

    Route::get('/videoPlayer', [VideoController::class, 'videoPlayer'])->name('videoplayer');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'Customer'])->group(function () {

    Route::post('/addtocart',[CartController::class,'addToCart'])->name('addToCart');
    Route::get('/cart',[CartController::class,'cart'])->name('cart');
    Route::post('/updateqty',[CartController::class,'qtyAction'])->name('updateqty');
    Route::post('/deleteCartItem',[CartController::class,'deleteCartItem'])->name('deleteCartItem');
    
    Route::get('/historyTransaction',[HistoryTransaction::class,'historyTransaction'])->name('historytransaction');
    
    Route::post('/checkout',[CheckOutController::class,'checkout'])->name('checkout');
    Route::get('/success',[CheckOutController::class,'success'])->name('success');
    Route::get('/failure',[CheckOutController::class,'failure'])->name('failure');
    Route::get('/canceled',[CheckOutController::class,'canceled'])->name('canceled');
});
