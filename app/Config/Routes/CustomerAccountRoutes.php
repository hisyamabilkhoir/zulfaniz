<?php
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}

$routes->get('eshop-admin/customer-accounts', 'CustomerAccountController::customer_accounts');
$routes->get('eshop-admin/customer-accounts/view-add', 'CustomerAccountController::customer_accounts_view_add');
$routes->post('eshop-admin/customer-accounts/add', 'CustomerAccountController::customer_accounts_add');
$routes->get('eshop-admin/customer-accounts/view-edit/(:num)', 'CustomerAccountController::customer_accounts_view_edit/$1');
$routes->post('eshop-admin/customer-accounts/update', 'CustomerAccountController::customer_accounts_update');
$routes->post('eshop-admin/customer-accounts/reset-password', 'CustomerAccountController::customer_accounts_reset_password');
