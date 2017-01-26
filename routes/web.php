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
    Route::get('/claim', 'ClaimController@index')->name('claim-index');
    Route::get('/claim/create', 'ClaimController@create')->name('claim-create');

    Route::get('/dashboard', 'DashboardController@getDashboardView')->name('dashboard');
    Route::get('/customer', 'CustomerController@getCustomerView')->name('customer');
    Route::get('/customer/create', 'CustomerController@create')->name('customer-create');

    Route::get('/part-order', 'PartOrderController@index')->name('part-order-index');
    Route::get('/part-order/create', 'PartOrderController@create')->name('part-order-create');

    Route::get('/product', 'ProductController@index')->name('product-index');
    Route::get('/product/create', 'ProductController@create')->name('product-create');

    // Repair Center
    Route::group(['prefix' => 'repair-center'], function() {
        // List
        Route::get('/',
            'RepairCenterController@getListView')->name('repair-center');
        // Add
        Route::get('/create',
            'RepairCenterController@getCreateView')->name('repair-center.create');
        Route::post('/create',
            'RepairCenterController@createRepairCenter')->name('repair-center.create');
        // Edit
        Route::get('/edit/{id}',
            'RepairCenterController@getEditView')->name('repair-center.edit');
        Route::post('/edit',
            'RepairCenterController@editRepairCenter')->name('repair-center.edit-post');
        // Delete
        Route::get('/delete/{id}/{name}',
            'RepairCenterController@deleteRepairCenter')->name('repair-center.delete');
    });
});

// /login, /logout, /register, /password/reset, /password/email
Auth::routes();