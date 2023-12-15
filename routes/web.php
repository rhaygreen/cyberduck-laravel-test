<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
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
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales');

Route::middleware(['auth'])->group(function(){

    //product routes
    Route::get('/products',
        [ProductController::class, 'index']
    )->name('product.index');

    Route::get('/product/{product}/calculateSellingPrice',
        [ProductController::class, 'calculateSellingPrice']
    )->name('product.selling.price');


    //Sales routes
    Route::get('/sales', function () {
        return view('coffee_sales');
    })->name('coffee.sales');

    Route::get('/sale',
        [SaleController::class, 'index']
    )->name('sale.index');

    Route::post('/sale/store',
        [SaleController::class, 'store']
    )->name('sale.store');

    //shipping partner routes
    Route::get('/shipping-partners', function () {
        return view('shipping_partners');
    })->name('shipping.partners');
});


require __DIR__.'/auth.php';
