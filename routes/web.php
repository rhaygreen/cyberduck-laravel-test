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

Route::get('/sales', function () {
    return view('coffee_sales');
})->middleware(['auth'])->name('coffee.sales');

Route::get('/sale',
    [SaleController::class, 'index']
)->middleware(['auth'])->name('sale.index');

Route::post('/sale/store',
    [SaleController::class, 'store']
)->middleware(['auth'])->name('sale.store');

Route::get('/product/{product}/calculateSellingPrice',
    [ProductController::class, 'calculateSellingPrice']
)->middleware(['auth'])->name('product.selling.price');

Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

require __DIR__.'/auth.php';
