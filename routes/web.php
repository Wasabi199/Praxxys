<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MainController;

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
    Route::get('/products', [MainController::class, 'products'])->name('products');
    Route::get('/create', [MainController::class, 'createProducts'])->name('create.products');

    Route::post('/addProducts', [MainController::class, 'addProducts'])->name('product.submit');
    Route::post('/deleteProduct', [MainController::class, 'deleteProduct'])->name('product.delete');
    Route::post('/updateProduct', [MainController::class, 'updateProduct'])->name('product.update');

    Route::get('/videoPlayer', [MainController::class, 'videoPlayer'])->name('videoplayer');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'Customer'])->group(function () {

    Route::post('/addtocart',[CustomerController::class,'addToCart'])->name('addToCart');
    Route::get('/cart',[CustomerController::class,'cart'])->name('cart');
    Route::post('/updateqty',[CustomerController::class,'qtyAction'])->name('updateqty');
    Route::post('/deleteCartItem',[CustomerController::class,'deleteCartItem'])->name('deleteCartItem');
    Route::post('/checkout',[CustomerController::class,'checkout'])->name('checkout');

    Route::get('/historyTransaction',[CustomerController::class,'historyTransaction'])->name('historytransaction');

    Route::get('/redirect/{link}',[CustomerController::class,'redirect'])->name('redirect');

    Route::get('/success',[CustomerController::class,'success'])->name('success');
    Route::get('/failure',[CustomerController::class,'failure'])->name('failure');
    Route::get('/canceled',[CustomerController::class,'canceled'])->name('canceled');
});
