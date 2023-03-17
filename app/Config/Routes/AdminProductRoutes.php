<?php
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}
$routes->get('eshop-admin/products', 'AdminProductController::admin_product');
$routes->get('eshop-admin/products/view-add', 'AdminProductController::admin_products_view_add');
$routes->post('eshop-admin/products/add', 'AdminProductController::admin_product_add_process');
$routes->post('eshop-admin/products/add_process', 'AdminProductController::admin_products_add_process');
$routes->post('eshop-admin/products/edit_process', 'AdminProductController::admin_products_edit_process');
$routes->get('eshop-admin/products/view_edit/(:num)', 'AdminProductController::admin_products_view_edit/$1');
$routes->get('eshop-admin/products/delete/(:num)', 'AdminProductController::admin_products_delete/$1');

//product Images
$routes->get('eshop-admin/product-images/(:num)/delete/(:num)', 'AdminProductController::admin_product_images_delete/$1/$2');

//Product Varian
$routes->get('eshop-admin/product/variants/(:num)', 'AdminProductController::admin_product_variants/$1');
$routes->post('eshop-admin/product/variants/add_process', 'AdminProductController::admin_product_variants_add_process');
$routes->post('eshop-admin/product/variants/view_edit', 'AdminProductController::admin_product_variants_edit');
$routes->post('eshop-admin/product/variants/edit_process', 'AdminProductController::admin_product_variants_edit_process');
$routes->get('eshop-admin/product/variants/delete/(:num)/(:num)', 'AdminProductController::admin_product_variants_delete/$1/$2');
