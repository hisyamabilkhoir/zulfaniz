<?php
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}
$routes->get('eshop-admin/categories', 'AdminCategoryController::admin_category');
$routes->post('eshop-admin/categories/add_process', 'AdminCategoryController::admin_category_add_process');
$routes->post('eshop-admin/categories/edit_process', 'AdminCategoryController::admin_category_edit_process');
$routes->post('eshop-admin/categories/view_edit/(:num)', 'AdminCategoryController::admin_category_view_edit/$1');
$routes->get('eshop-admin/categories/delete/(:num)', 'AdminCategoryController::admin_category_delete/$1');
