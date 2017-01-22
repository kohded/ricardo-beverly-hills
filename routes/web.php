<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@getHomeView')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/claim', 'ClaimController@getClaimView')->name('claim');
    Route::get('/dashboard', 'DashboardController@getDashboardView')->name('dashboard');
    Route::get('/customer', 'CustomerController@getCustomerView')->name('customer');
    Route::get('/part-order', 'PartOrderController@getPartOrderView')->name('part-order');
    Route::get('/product', 'ProductController@getProductView')->name('product');
    Route::get('/repair-center', 'RepairCenterController@getRepairCenterView')->name('repair-center');
});

// /login, /logout, /register, /password/reset, /password/email
Auth::routes();