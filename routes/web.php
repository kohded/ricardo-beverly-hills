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

    // Customer
    Route::group(['prefix' => 'customer'], function() {
        // List / Index
        Route::get('/', 'CustomerController@getCustomerView')->name('customer');
        // Add
        Route::get('/create', 'CustomerController@getCreateView')->name('customer-create');
        Route::post('/create', 'CustomerController@addCustomer')->name('customer-create');

        Route::get('/more-details/{customerId}', 'CustomerController@getCustomerDetails')->name('more-customer-details');
    });

    // Product
    Route::group(['prefix' => 'product'], function() {
        // List / Index
        Route::get('/', 'ProductController@index')->name('product');
        // Add
        Route::get('/create', 'ProductController@getCreateView')->name('product.create');
        Route::post('/create', 'ProductController@createProduct')->name('product.create');
        // Edit
        Route::get('/edit/{style}', 'ProductController@getEditView')->name('product.edit');
        Route::post('/edit', 'ProductController@editProduct')->name('product.edit-post');
        // Delete
        Route::get('/delete/{style}/{description}', 'ProductController@deleteProduct')->name('product.delete');
    });


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