<?php
$routes->get('eshop-admin/create-admin', 'AdminController::create_admin');
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}

$routes->get('eshop-admin/report-orders', 'AdminReportController::report_orders');
$routes->get('eshop-admin/report-orders-print', 'AdminReportController::report_orders_print');
