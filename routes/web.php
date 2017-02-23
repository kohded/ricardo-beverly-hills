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

// Authentication Routes - /login, /logout, /password/reset, /password/reset/{token}
Auth::routes();

// Home
Route::get('/', 'HomeController@getHomeView')->name('home');

// Ricardo Beverly Hills Role
Route::group(['middleware' => 'role:ricardo-beverly-hills'], function() {
    // Registration Routes - Only a RBH employee can register a user.
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'Auth\RegisterController@register');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@getDashboardView')->name('dashboard');

    // Claim
    Route::group(['prefix' => 'claim'], function() {
        // List
        Route::get('/', 'ClaimController@index')->name('claim-index');
        // Add
        Route::get('/create', 'ClaimController@getCreateView')->name('claim-create');
        // Insert
        Route::post('/create', 'ClaimController@addClaim')->name('claim.create');
        // Detail
        Route::get('/more-details/{id}', 'ClaimController@getClaimDetails')->name('claim');
        // edit
        Route::get('/edit/{id}', 'ClaimController@editClaim')->name('claim.edit');
        // delete
        Route::get('/delete/{id}', 'ClaimController@deleteClaim')->name('claim.delete');
        // Add a new comment
        Route::post('/add-comment', 'ClaimController@addComment')->name('claim.add-comment');
    });

    // Customer
    Route::group(['prefix' => 'customer'], function() {
        // List / Index
        Route::get('/', 'CustomerController@getCustomerView')->name('customer');
        // Add
        Route::get('/create', 'CustomerController@getCreateView')->name('customer-create');
        // Insert
        Route::post('/create', 'CustomerController@addCustomer')->name('customer-create');
        // Edit
        Route::get('/edit/{customerId}', 'CustomerController@getEditView')->name('customer-get-edit');
        Route::post('/edit', 'CustomerController@editCustomer')->name('customer-edit');
        // Individual customer detail
        Route::get('/more-details/{customerId}', 'CustomerController@getCustomerDetails')->name('more-customer-details');
        // Delete
        Route::get('/delete/{customerId}', 'CustomerController@deleteCustomer')->name('customer.delete');
    });

    // Product
    Route::group(['prefix' => 'product'], function() {
        // List / Index
        Route::get('/',
            'ProductController@index')->name('product');
        // Add
        Route::get('/create',
            'ProductController@getCreateView')->name('product.create');
        Route::post('/create',
            'ProductController@createProduct')->name('product.create');
        // Edit
        Route::get('/edit/{style}',
            'ProductController@getEditView')->name('product.edit');
        Route::post('/edit',
            'ProductController@editProduct')->name('product.edit-post');
        // Delete
        Route::get('/delete/{style}/{description}',
            'ProductController@deleteProduct')->name('product.delete');
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

    // Mail
    Route::group(['prefix' => 'mail'], function() {
        // Claim Confirmation
        Route::post('/claim-confirmation',
            'Mail\ClaimConfirmationController@sendMail')->name('mail.claim-confirmation');
    });
});

// Part Company Role
Route::group(['middleware' => 'role:part-company'], function() {
    Route::group(['prefix' => 'part-company-claim'], function() {

    });
});

// Repair Center Role
Route::group(['middleware' => 'role:repair-center'], function() {
    Route::group(['prefix' => 'repair-center-claim'], function() {

    });
});