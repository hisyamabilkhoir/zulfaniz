<?php

//sebelum login
$routes->get('/', 'CustomerController::home');
$routes->get('/products', 'CustomerController::products');
$routes->post('/products/by/category', 'CustomerController::products_by_category');
$routes->post('/products/search', 'CustomerController::products_search');
$routes->get('/product/detail/(:any)', 'CustomerController::product_detail/$1');
$routes->post('/product/detail/select-variant', 'CustomerController::product_detail_select_variant');
$routes->get('/contact', 'CustomerController::contact');
$routes->post('/contact/send', 'CustomerController::contact_send');
$routes->get('/eshop-customer', 'CustomerController::login');
$routes->post('/eshop-customer/process-login', 'CustomerController::process_login');
$routes->get('/eshop-customer/registration', 'CustomerController::registration');
$routes->post('/eshop-customer/process-registration', 'CustomerController::process_registration');
$routes->get('/eshop-customer/profile', 'CustomerController::profile');
$routes->post('/eshop-customer/profile/set-photo', 'CustomerController::profile_set_photo');
$routes->get('/eshop-customer/profile/edit', 'CustomerController::profile_edit');
$routes->post('/eshop-customer/profile/update', 'CustomerController::profile_update');
$routes->get('/eshop-customer/password/edit', 'CustomerController::password_edit');
$routes->post('/eshop-customer/password/update', 'CustomerController::password_update');
$routes->get('/eshop-customer/cart', 'CustomerController::cart');
$routes->post('/eshop-customer/add-to-cart', 'CustomerController::add_to_cart');
$routes->post('/eshop-customer/update-item-cart', 'CustomerController::update_item_cart');
$routes->post('/eshop-customer/remove-item-cart', 'CustomerController::remove_item_cart');
$routes->get('/eshop-customer/checkout', 'CustomerController::checkout');
$routes->get('/eshop-customer/logout', 'CustomerController::logout');
