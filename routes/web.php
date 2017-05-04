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

// First check if user is authenticated before moving on to role middleware
Route::group(['middleware' => 'auth'], function() {
    // Ricardo Beverly Hills Role
    Route::group(['middleware' => 'role:ricardo-beverly-hills'], function() {
        // Registration Routes - Only a RBH employee can register a user.
        $this->get('register', 'Auth\RegisterController@showRegistrationForm')
            ->name('register');
        $this->post('register', 'Auth\RegisterController@register');

        // Dashboard
        Route::get('/dashboard', 'DashboardController@getDashboardView')
            ->name('dashboard');


    	// Claim
    	Route::group(['prefix' => 'claim'], function() {
    	    // List
    	    Route::get('/', 'ClaimController@getClaimIndex')
                ->name('claim-index');
            Route::get('/filtered/{filterType}/{filterOrder}', 'ClaimController@setFilter')
                ->name('claim-filter-index');
    	    // Add
    	    Route::get('/create', 'ClaimController@getCreateView')
    	        ->name('claim-create');
    	    // Insert
    	    Route::post('/create', 'ClaimController@addClaim')
    	        ->name('claim.create');
    	    // Detail
    	    Route::get('/more-details/{id}', 'ClaimController@getClaimDetails')
    	        ->name('claim');
            // Create claim PDF
            Route::get('/pdf/{id}', 'ClaimController@displayClaimPDF')
                ->name('claim-pdf');            
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
    	    // Add tracking (RBH)
    	    Route::post('/enter-tracking-number', 'ClaimController@enterTrackingNumber')
    	        ->name('claim.enter-tracking-number');
    	    // Close claim
    	    Route::get('/close/{id}', 'ClaimController@closeClaim')
    	        ->name('close-claim');	            
    	});

    	// Customer
    	Route::group(['prefix' => 'customer'], function() {
    	    // List / Index
    	    Route::get('/', 'CustomerController@getCustomerIndex')
    	        ->name('customer');
            Route::get('/filtered/{filterType}/{filterOrder}', 'CustomerController@setFilter')
                ->name('customer-filter-index');
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
            Route::get('/filtered/{filterType}/{filterOrder}', 'DamageCodeController@setFilter')
                ->name('damage-code-filter-index');
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
    	    Route::post('/delete', 'DamageCodeController@deleteDamageCode')
    	        ->name('damage-code.delete');
    	});

    	// Product
    	Route::group(['prefix' => 'product'], function() {
    	    // List / Index
    	    Route::get('/', 'ProductController@index')
    	        ->name('product');
            Route::get('/filtered/{filterType}/{filterOrder}', 'ProductController@setFilter')
                ->name('product-filter-index');
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
            Route::get('/filtered/{filterType}/{filterOrder}', 'RepairCenterController@setFilter')
                ->name('repair-center-filter-index');
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

    	// Autocomplete
        Route::group(['prefix' => 'autocomplete'], function() {
            // Customer Email
            Route::get('/customer-email', 'Autocomplete\AutocompleteController@getCustomerEmail')
                ->name('autocomplete.customer-email');
            // Product
            Route::get('/product', 'Autocomplete\AutocompleteController@getProduct')
                ->name('autocomplete.product');
            // Repair Center
            Route::get('/repair-center', 'Autocomplete\AutocompleteController@getRepairCenter')
                ->name('autocomplete.repair-center');
        });
    });


    // Part Company Role
    Route::group(['middleware' => 'role:part-company'], function() {
        Route::group(['prefix' => 'part-company-claim'], function() {
            // List
            Route::get('/', 'Role\PartCompany\PartCompanyController@getListView')
                ->name('pc-claim-list');
            Route::get('/more-details/{id}', 'Role\PartCompany\PartCompanyController@getClaimDetails')
                ->name('pc-claim-details');
    	    // Add part availability (TWC)
    	    Route::post('/enter-part-availability', 'Role\PartCompany\PartCompanyController@enterPartAvailability')
    	        ->name('pc-enter-part-availability'); 
    	    // Add tracking (TWC)
    	    Route::post('/enter-tracking-number', 'Role\PartCompany\PartCompanyController@enterTrackingNumber')
    	        ->name('pc-enter-tracking-number'); 
    	   	    // Add a new comment
    	    Route::post('/add-comment', 'Role\PartCompany\PartCompanyController@addComment')
    	        ->name('pc-add-comment');
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
});