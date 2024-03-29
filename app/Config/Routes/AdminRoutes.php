<?php
$routes->get('eshop-admin/create-admin', 'AdminController::create_admin');
if (session()->get('logged_in_admin') == null) {
    $routes->get("eshop-admin/(:any)", "AdminController::dashboard", ['filter' => 'login_admin']);
}

if (session()->get('logged_in_admin')) {
    $routes->get("eshop-admin", "AdminController::login", ['filter' => 'logout_admin']);
}

//login
$routes->get('eshop-admin', 'AdminController::login');
$routes->post('eshop-admin/process-login', 'AdminController::process_login');
$routes->get('eshop-admin/logout', 'AdminController::logout');
$routes->get('eshop-admin/profile', 'AdminController::profile');
$routes->post('eshop-admin/profile/save', 'AdminController::save_profile');
$routes->post('eshop-admin/profile/password/reset', 'AdminController::profile_reset_password');
//menu
$routes->get('eshop-admin/dashboard', 'AdminController::dashboard');
$routes->get('eshop-admin/messages', 'AdminController::messages');
$routes->post('eshop-admin/message/whatsapp', 'AdminController::message_whatsapp');
$routes->post('eshop-admin/message/whatsapp/reply', 'AdminController::message_whatsapp_reply');
$routes->post('eshop-admin/message/whatsapp/reply_send/(:any)', 'AdminController::message_whatsapp_reply_send/$1');
$routes->post('eshop-admin/message/gmail', 'AdminController::message_gmail');
$routes->get('eshop-admin/message/gmail/reply/(:any)', 'AdminController::message_gmail_reply/$1');


















































































//FAyyaz