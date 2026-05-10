<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::Register');
$routes->get('/register', 'Auth::Register');
$routes->post('/register', 'Auth::store');
