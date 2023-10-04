<?php

use App\Http\Controllers\MainController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return Redirect::route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [MainController::class, 'products'])->name('products');
    Route::get('/create', [MainController::class, 'createProducts'])->name('create.products');

    Route::post('/addProducts', [MainController::class, 'addProducts'])->name('product.submit');
    Route::delete('/deleteProduct', [MainController::class, 'deleteProduct'])->name('product.delete');
    Route::post('/updateProduct', [MainController::class, 'updateProduct'])->name('product.update');

    Route::get('/videoPlayer',[MainController::class,'videoPlayer'])->name('videoplayer');
});
