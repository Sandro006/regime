<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes d'authentification
$routes->get('/register', 'Auth::Register');
$routes->post('/register', 'Auth::store');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');


// Routes pour le profil utilisateur
$routes->get('/profile', 'Profile::profile');

