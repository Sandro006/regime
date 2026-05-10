<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::Register');
$routes->get('/register', 'Auth::Register');
$routes->post('/register', 'Auth::store');
$routes->get('/login', 'Auth::loginPage');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/accueil', 'Auth::accueil');
$routes->get('/logout', 'Auth::logout');