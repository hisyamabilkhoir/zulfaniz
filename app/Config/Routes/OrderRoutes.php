<?php
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}
$routes->get('eshop-admin/orders', 'AdminOrderController::admin_orders');
$routes->get('eshop-admin/order/(:num)', 'AdminOrderController::admin_order/$1');
// $routes->post('eshop-admin/orders/add_process', 'AdminOrderController::admin_order_add_process');
// $routes->post('eshop-admin/orders/edit_process', 'AdminOrderController::admin_order_edit_process');
// $routes->post('eshop-admin/orders/view_edit/(:num)', 'AdminOrderController::admin_order_view_edit/$1');
// $routes->get('eshop-admin/orders/delete/(:num)', 'AdminOrderController::admin_order_delete/$1');
