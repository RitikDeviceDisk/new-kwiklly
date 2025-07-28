<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\AddressController;

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

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('clear-compiled');
    echo '<center> Cache cleared!!</center>';
    // return view('admin/dashboard.clear_cache');
})->name('clear.all.cache');

require __DIR__ . '/admin.php';
require __DIR__ . '/vendor.php';
require __DIR__ . '/customer.php';
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('checkout-page/', function () {
    return view('web.checkoutaddress');
});
Route::get('checkout-delivery-page/', function () {
    return view('web.checkoutdelivery');
});

/*Website-------------------------------*/
  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/department', [HomeController::class, 'department'])->name('department');
  Route::get('/stores/{slug?}', [HomeController::class, 'stores'])->name('stores');
  Route::get('/productdetails', [HomeController::class, 'productdetails'])->name('productdetails');
  Route::get('/explorestore/{vendor_id}/{category_id}', [HomeController::class, 'explorestore'])->name('explorestore');
Route::get('/explorestore/{vendor_id}/{category_id}/{subcategory_id}', [HomeController::class, 'subcategoryProducts'])->name('subcategory.products');


  Route::get('/searchresults', [HomeController::class, 'searchresults'])->name('searchresults');
  Route::get('/get-product-variants/{id}', [HomeController::class, 'getProductVariants'])->name('get.product.variants');

  // web.php
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/increment', [CartController::class, 'incrementQty'])->name('cart.increment');
Route::post('/cart/decrement', [CartController::class, 'decrementQty'])->name('cart.decrement');
Route::get('/cart-data', [CartController::class, 'getCartData'])->name('cart.data');


Route::get('/auth-status', function () {
    return response()->json(['logged_in' => auth()->check()]);
})->name('check.auth.status');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.page');
// });



Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.page');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/order-success', fn () => view('web.order_success'))->name('order.success');

    // Customer Address Routes
    Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');
    Route::post('/address/update/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/address/delete/{id}', [AddressController::class, 'delete'])->name('address.delete');
    Route::get('/customer/addresses', [AddressController::class, 'getAddresses'])->name('address.list');


});



  /*End Website-------------------------------*/



