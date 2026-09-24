<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('bukutamu-masuk', 'AuthController::index');
$routes->post('bukutamu-masuk', 'AuthController::authenticate');
$routes->get('bukutamu-keluar', 'AuthController::logout');

$routes->get(
    'admin/bukutamu-dashboard',
    'DashboardController::index',
    ['filter' => ['auth', 'role:administrator']]
);
