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

$routes->get('/search', 'OsController::search');
