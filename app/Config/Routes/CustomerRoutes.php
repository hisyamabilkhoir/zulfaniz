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
$routes->post('/process-login', 'CustomerController::process_login');
$routes->get('/registration', 'CustomerController::registration');
$routes->post('/process-registration', 'CustomerController::process_registration');


if (session()->get('logged_in_customer') == null) {
    $routes->get("eshop-customer/(:any)", "CustomerController::profile", ['filter' => 'login_customer']);
}

if (session()->get('logged_in_customer')) {
    $routes->get("eshop-customer", "CustomerController::login", ['filter' => 'logout_customer']);
}

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
$routes->post('/eshop-customer/get-cities', 'CustomerController::get_cities');
$routes->post('/eshop-customer/get-cost', 'CustomerController::get_costs');
$routes->post('/eshop-customer/checkout/process', 'CustomerController::process_checkout');
$routes->get('/eshop-customer/order-histories', 'CustomerController::order_histories');
$routes->get('/eshop-customer/order-history/(:any)', 'CustomerController::order_history/$1');
$routes->get('/eshop-customer/logout', 'CustomerController::logout');
$routes->get('/eshop-customer/order/(:segment)/status/(:alpha)/update', 'CustomerController::order_update_status/$1/$2');
