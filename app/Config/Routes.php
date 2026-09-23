<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');
