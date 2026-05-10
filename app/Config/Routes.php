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

// Routes objectifs
$routes->get('/objectif/list', 'Objectif::list');
$routes->post('/objectif/save', 'Objectif::save');

// Routes activites
$routes->get('/activite/list', 'Activite::list');
$routes->get('/activite/recommended', 'Activite::recommended');

