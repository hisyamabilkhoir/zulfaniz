<?php
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}

$routes->get('eshop-admin/admin-accounts', 'AdminAccountController::admin_accounts');
$routes->get('eshop-admin/admin-accounts/view-add', 'AdminAccountController::admin_accounts_view_add');
$routes->post('eshop-admin/admin-accounts/add', 'AdminAccountController::admin_accounts_add');
