<?php

//Auth
$router->get('auth/login', 'AuthController@login');
$router->post('auth/login', 'AuthController@doLogin');
$router->get('auth/logout', 'AuthController@logout');

//Admin
$router->get('admin/dashboard', 'AdminController@dashboard');
$router->get('admin/profile', 'AdminController@profile');
$router->post('admin/profile/update', 'AdminController@updateProfile');
$router->post('admin/change-password', 'AdminController@changePassword');

//User
$router->get('users', 'UserController@index');
$router->get('user/create', 'UserController@create');
$router->post('user/store', 'UserController@store');
$router->get('user/edit/:id', 'UserController@edit');
$router->post('user/update', 'UserController@update');
$router->get('user/delete/:id', 'UserController@delete');
$router->get('user/profile', 'ProfileController@profile');
$router->post('user/profile/update', 'ProfileController@updateProfile');

//Customer
$router->get('customers', 'CustomerController@index');
$router->get('customer/create', 'CustomerController@create');
$router->post('customer/store', 'CustomerController@store');
$router->get('customer/edit/:id', 'CustomerController@edit');
$router->post('customer/update', 'CustomerController@update');
$router->get('customer/delete/:id', 'CustomerController@delete');
$router->post('customer/addSize', 'CustomerController@addAndUpdateSize');
$router->get('customer/deleteSize/:id/:customerId', 'CustomerController@deleteSize');

//Transaction
$router->get('transactions', 'TransactionController@index');
$router->get('transaction/create', 'TransactionController@create');
$router->post('transaction/store', 'TransactionController@store');
$router->get('transaction/edit/:id', 'TransactionController@edit');
$router->post('transaction/update', 'TransactionController@update');
$router->get('transaction/delete/:id', 'TransactionController@delete');

//Agency
$router->get('agencies', 'AgencyController@index');
$router->get('agency/create', 'AgencyController@create');
$router->post('agency/store', 'AgencyController@store');
$router->get('agency/edit/:id', 'AgencyController@edit');
$router->post('agency/update', 'AgencyController@update');
$router->get('agency/delete/:id', 'AgencyController@delete');

//API - Transaction
$router->get('api/get-size-properties', 'TransactionController@getSizeProperties');
$router->get('api/get-size-details', 'CustomerController@getSizeDetail');
$router->get('api/get-customerSizeByCustomerId/:customerId/:headerSizeId/:itemId', 'CustomerController@getAllSizes');

//Dashboard
$router->get('', 'DashboardController@index');
$router->get('dashboard', 'DashboardController@index');
?>