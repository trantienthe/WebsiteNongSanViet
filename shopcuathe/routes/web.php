<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
 

//-------LOGIN--------
//------checkout------
//-----dangki---------
//-----dangnhap------
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/dangkiuser', 'App\Http\Controllers\CheckoutController@dangkiuser');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');


//danh sach san pham
Route::get('/category/{slug}/{id}', [
    'as' => 'category.product',
    'uses' => 'App\Http\Controllers\CategoryController@index'
]);

//chi tiet  san pham
Route::get('/chitietsanpham/{id}', [
    'as' => 'chitietsanpham.details_product',
    'uses' => 'App\Http\Controllers\ProductController@details_product'
]);


Route::get(uri: '/', action: 'App\Http\Controllers\HomeController@index')->name('home');


//them gio hang
Route::get(uri: '/add-to-cart/{id}', action: 'App\Http\Controllers\HomeController@addToCart')->name('addToCart');
Route::post(uri: '/add-to-cart', action: 'App\Http\Controllers\HomeController@addToCart2')->name('addToCart2');
//show gio hang
Route::get(uri: '/show-cart', action: 'App\Http\Controllers\HomeController@showCart')->name('showCart');
//update gio hang
Route::get(uri: '/update-cart', action: 'App\Http\Controllers\HomeController@updateCart')->name('updateCart');
//delete gio hang
Route::get(uri: '/delete-cart', action: 'App\Http\Controllers\HomeController@deleteCart')->name('deleteCart');

//tim kiem
Route::post(uri: '/tim-kiem', action: 'App\Http\Controllers\HomeController@search');


//lịch sử đơn hàng
Route::get(uri: '/history', action: 'App\Http\Controllers\HomeController@history');
//chitiet don hang
Route::get('/view-order/{orderId}', 'App\Http\Controllers\HomeController@view_order');
//xoa don hang
Route::get('/delete-order/{order_id}', 'HomeController@delete_order');


// send mail

Route::get('/contact','HomeController@contact');
Route::post('/send-mail', 'HomeController@send_mail');

