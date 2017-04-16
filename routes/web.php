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
Route::get('/', function() {
    if (Auth::check()) {
        if(Auth::user()->hasRole('ricardo-beverly-hills')) {
            return redirect('/claim');
        } else if (Auth::user()->hasRole('part-company'))
        {
            return redirect('/part-company-claim');
        }
    } else {
        return redirect('/login');
    }
})->name('home');

// Ricardo Beverly Hills Role
Route::group(['middleware' => 'role:ricardo-beverly-hills'], function() {
    // Registration Routes - Only a RBH employee can register a user.
    $this->get('register', 'Auth\RegisterController@showRegistrationForm')
        ->name('register');
    $this->post('register', 'Auth\RegisterController@register');

    // Dashboard
    Route::get('/dashboard', 'DashboardController@getDashboardView')
        ->name('dashboard');
});

// Claim
Route::group(['prefix' => 'claim'], function() {
    // List
    Route::get('/', 'ClaimController@getRicardoIndex')
        ->name('claim-index');
    // Add
    Route::get('/create', 'ClaimController@getCreateView')
        ->name('claim-create');
    // Insert
    Route::post('/create', 'ClaimController@addClaim')
        ->name('claim.create');
    // Detail
    Route::get('/more-details/{id}', 'ClaimController@getClaimDetails')
        ->name('claim');
    // edit
    Route::get('/edit/{id}', 'ClaimController@editClaim')
        ->name('claim.edit');
    Route::post('/edit', 'ClaimController@updateClaim')
        ->name('update-claim');
    // delete
    Route::post('/delete', 'ClaimController@deleteClaim')
        ->name('claim.delete');
    // Add a new comment
    Route::post('/add-comment', 'ClaimController@addComment')
        ->name('claim.add-comment');
    // Convert to Replace Order
    Route::post('/convert-to-replace-order', 'ClaimController@convertToReplaceOrder')
        ->name('claim.convert-to-replace-order');
    // Add part availability (TWC)
    Route::post('/enter-part-availability', 'ClaimController@enterPartAvailability')
        ->name('claim.enter-part-availability'); 
    // Add tracking (TWC / RBH)
    Route::post('/enter-tracking-number', 'ClaimController@enterTrackingNumber')
        ->name('claim.enter-tracking-number');        
});

// Customer
Route::group(['prefix' => 'customer'], function() {
    // List / Index
    Route::get('/', 'CustomerController@getCustomerView')
        ->name('customer');
    // Add
    Route::get('/create', 'CustomerController@getCreateView')
        ->name('customer-create');
    // Insert
    Route::post('/create', 'CustomerController@addCustomer')
        ->name('customer-create');
    // Edit
    Route::get('/edit/{customerId}', 'CustomerController@getEditView')
        ->name('customer-get-edit');
    Route::post('/edit', 'CustomerController@editCustomer')
        ->name('customer-edit');
    // Individual customer detail
    Route::get('/more-details/{customerId}', 'CustomerController@getCustomerDetails')
        ->name('more-customer-details');
    // Delete
    Route::post('/delete', 'CustomerController@deleteCustomer')
        ->name('customer.delete');
});

// Damage Code
Route::group(['prefix' => 'damage-code'], function() {
    // List
    Route::get('/', 'DamageCodeController@getListView')
        ->name('damage-code');
    // Add
    Route::get('/create', 'DamageCodeController@getCreateView')
        ->name('damage-code.create');
    Route::post('/create', 'DamageCodeController@createDamageCode')
        ->name('damage-code.create');
    // Edit
    Route::get('/edit/{id}', 'DamageCodeController@getEditView')
        ->name('damage-code.edit');
    Route::post('/edit', 'DamageCodeController@editDamageCode')
        ->name('damage-code.edit-post');
    // Delete
    Route::get('/delete/{id}/{name}', 'DamageCodeController@deleteDamageCode')
        ->name('damage-code.delete');
});

// Product
Route::group(['prefix' => 'product'], function() {
    // List / Index
    Route::get('/', 'ProductController@index')
        ->name('product');
    // Add
    Route::get('/create', 'ProductController@getCreateView')
        ->name('product.create');
    Route::post('/create', 'ProductController@createProduct')
        ->name('product.create');
    // Edit
    Route::get('/edit/{style}', 'ProductController@getEditView')
        ->name('product.edit');
    Route::post('/edit', 'ProductController@editProduct')
        ->name('product.edit-post');
    // Delete
    Route::post('/delete', 'ProductController@deleteProduct')
        ->name('product.delete');
});

// Repair Center
Route::group(['prefix' => 'repair-center'], function() {
    // List
    Route::get('/', 'RepairCenterController@getListView')
        ->name('repair-center');
    // Add
    Route::get('/create', 'RepairCenterController@getCreateView')
        ->name('repair-center.create');
    Route::post('/create', 'RepairCenterController@createRepairCenter')
        ->name('repair-center.create');
    // Edit
    Route::get('/edit/{id}', 'RepairCenterController@getEditView')
        ->name('repair-center.edit');
    Route::post('/edit', 'RepairCenterController@editRepairCenter')
        ->name('repair-center.edit-post');
    // Delete
    Route::post('/delete', 'RepairCenterController@deleteRepairCenter')
        ->name('repair-center.delete');
});


// Part Company Role
Route::group(['middleware' => 'role:part-company'], function() {
    Route::group(['prefix' => 'part-company-claim'], function() {
        // List
        Route::get('/', 'ClaimController@getPartCompanyIndex')
            ->name('part-company-claim');
        Route::get('/more-details/{id}', 'ClaimController@getClaimDetails')
            ->name('part-company-claim-details');
    });
});

// Repair Center Role
Route::group(['middleware' => 'role:repair-center'], function() {
    Route::group(['prefix' => 'repair-center-claim'], function() {
        // List
        Route::get('/', 'Role\RepairCenter\RepairCenterController@getListView')
            ->name('repair-center-claim');
        // More Details
        Route::get('/more-details/{id}', 'Role\RepairCenter\RepairCenterController@getMoreDetailsView')
            ->name('repair-center-claim.more-details');
        // Add Comment
        Route::post('/add-comment', 'Role\RepairCenter\RepairCenterController@addComment')
            ->name('repair-center-claim.add-comment');
    });
});