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

//Dashboard
$router->get('', 'DashboardController@index');
$router->get('dashboard', 'DashboardController@index');
?>