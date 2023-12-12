<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'userController::index');
$routes->post('/', 'userController::index');
$routes->get('/logout', 'userController::logout'); 

$routes->get('/orders', 'osController::index', ['filter' => 'auth']);
$routes->get('/VerOs', 'osController::ver', ['filter' => 'auth']);
$routes->get('/perfil', 'userController::perfil', ['filter' => 'auth']);
$routes->get('/detalhesOS/(:num)', 'osController::detalhes/$1', ['filter' => 'auth']);
$routes->get('/Ver', 'ListarController::listar', ['filter' => 'auth']);
$routes->get('/detalhes/(:segment)/(:num)', 'ListarController::detalhes/$1/$2', ['filter' => 'auth']);
$routes->get('/adicionar', 'AddController::adicionar', ['filter' => 'auth']);
$routes->get('/adicionarAdmin', 'osController::adicionarAdmin', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/adicionar/(:segment)', 'AddController::adicionar/$1');

$routes->group('cliente', function ($routes) {
    $routes->get('/adicionar/(:segment)', 'AddController::adicionar/$1');
    $routes->post('/adicionar/(:segment)', 'AddController::adicionar/$1');

});

$routes->get('editar/(:segment)/(:num)', 'EditarController::editar/$1/$2');
$routes->post('editar/(:segment)/(:num)', 'EditarController::atualizar/$1/$2');




$routes->get('alterar-status-(:segment)/(:num)', 'ListarController::alterarStatus/$1/$2');


$routes->get('modelos_by_marca/(:num)', 'AddController::getModelosByMarca/$1');   

$routes->post('/adicionarOS', 'osController::adicionarOS');
$routes->get('/adicionarOS', 'osController::adicionarOS');

$routes->post('/searchVeiculo', 'osController::searchVeiculo');

$routes->group('user', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('forgot-password', 'UserController::forgotpassword2');
    $routes->post('forgot-password', 'UserController::forgotPassword');
$routes->get('reset-password', 'UserController::forgotPassword3');
$routes->post('send-reset-code', 'UserController::sendResetCode');
$routes->get('confirm-code', 'UserController::confirmCode');
$routes->post('verify-code', 'UserController::verifyCode');
    $routes->post('reset-password', 'userController::resetPassword');
});


$routes->get('/faturamento/(:num)', 'osController::Faturamento/$1');
$routes->get('/gerarPdf/(:num)', 'osController::gerarPdf/$1');
$routes->get('/os/editar/(:segment)', 'OsController::editar/$1');
$routes->post('/os/editar/(:segment)', 'OsController::editar/$1');
$routes->post('/os/editar/(:segment)', 'OsController::atualizar/$1');
$routes->post('/request_part', 'ListarController::requestPart');
$routes->post('/request_part2', 'ListarController::requestPart2');