<?php

//sebelum login
$routes->get('/', 'CustomerController::home');
$routes->get('/products', 'CustomerController::products');
$routes->get('/product/detail/(:any)', 'CustomerController::product_detail/$1');
$routes->get('/contact', 'CustomerController::contact');
$routes->get('/eshop-customer', 'CustomerController::login');
$routes->post('/eshop-customer/process-login', 'CustomerController::process_login');
$routes->get('/eshop-customer/registration', 'CustomerController::registration');
$routes->post('/eshop-customer/process-registration', 'CustomerController::process_registration');
$routes->get('/eshop-customer/profile', 'CustomerController::profile');
$routes->get('/eshop-customer/profile/edit', 'CustomerController::profile_edit');
$routes->post('/eshop-customer/profile/update', 'CustomerController::profile_update');
$routes->get('/eshop-customer/password/edit', 'CustomerController::password_edit');
$routes->post('/eshop-customer/password/update', 'CustomerController::password_update');
$routes->get('/eshop-customer/cart', 'CustomerController::cart');
$routes->get('/eshop-customer/checkout', 'CustomerController::checkout');
$routes->get('/eshop-customer/logout', 'CustomerController::logout');
