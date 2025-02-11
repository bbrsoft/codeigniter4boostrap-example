<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('excel/export', 'ExcelController::export');
$routes->get('excel/import-form', function () {
    return view('import');
});
$routes->post('excel/import', 'ExcelController::import');
$routes->get('qrcode', 'QrcodeController::index');
$routes->get('qrcode/generate', 'QrcodeController::generate');
$routes->get('whatsapp/send', 'WhatsAppController::send');

$routes->get('user', 'UserController::index');
$routes->get('user/fetch', 'UserController::fetch');

$routes->get('usercards', 'UserCardsController::index');
$routes->get('usercards/fetch', 'UserCardsController::fetch');

$routes->get('documents', 'DocumentController::index');
$routes->get('documents/create', 'DocumentController::create');
$routes->post('documents/store', 'DocumentController::store');
$routes->post('documents/delete/(:num)', 'DocumentController::delete/$1');

$routes->get('file-manager', 'FileManagerController::index');
$routes->post('file-manager/upload', 'FileManagerController::upload');
$routes->post('file-manager/delete', 'FileManagerController::delete');
$routes->post('file-manager/rename', 'FileManagerController::rename');
$routes->post('file-manager/move', 'FileManagerController::move');
$routes->post('file-manager/copy', 'FileManagerController::copy');
$routes->get('file-manager/folder/(:any)', 'FileManagerController::index/$1');


$routes->get('pdf/surat', 'PdfController::generate');
$routes->get('email/send', 'EmailController::send');

// $routes->resource('api'); // Untuk API Server
$routes->resource('api', ['controller' => 'ApiController']);

$routes->get('client/getAllUsers', 'ClientController::getAllUsers');
$routes->get('client/getUser/(:num)', 'ClientController::getUser/$1');
$routes->post('client/addUser', 'ClientController::addUser');
