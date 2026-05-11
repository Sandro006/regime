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

// Routes back-office (admin)
$routes->get('/admin/login', 'Admin\\Auth::login');
$routes->post('/admin/authenticate', 'Admin\\Auth::authenticate');
$routes->get('/admin/logout', 'Admin\\Auth::logout');


// Routes pour le profil utilisateur
$routes->get('/profile', 'Profile::index');
$routes->get('/profile/edit', 'Profile::edit');
$routes->post('/profile/doEdit', 'Profile::doEdit');
$routes->get('/profile/editObjectif', 'Profile::editObjectif');
$routes->post('/profile/doEditObjectif', 'Profile::doEditObjectif');

// Routes historique
$routes->get('/profile/getHistory', 'Profile::getHistory');
$routes->post('/profile/updateMetrics', 'Profile::updateMetrics');

// Routes objectifs
$routes->get('/objectif/list', 'Objectif::list');
$routes->post('/objectif/save', 'Objectif::save');

// Routes activites
$routes->get('/activite', 'Activite::list');  // Add this line
$routes->get('/activite/list', 'Activite::list');
$routes->get('/activite/recommended', 'Activite::recommended');

// Routes regimes
$routes->get('/regime', 'Regime::list');
$routes->get('/regime/list', 'Regime::list');
$routes->get('/regime/detail/(:num)', 'Regime::detail/$1');
$routes->get('/regime/recommended', 'Regime::recommended');

//Routes portefeuille
$routes->get('/portefeuille', 'Portefeuille::index');
$routes->get('/portefeuille/recharger', 'Portefeuille::recharger');
$routes->post('/portefeuille/validerCode', 'Portefeuille::validerCode');

// Routes achat régimes
$routes->post('/achat/acheterRegime/(:num)', 'Achat::acheterRegime/$1');
$routes->get('/achat/mesRegimes', 'Achat::mesRegimes');
$routes->post('/achat/completerRegime/(:num)', 'Achat::completerRegime/$1');
$routes->get('/achat/exportRegimesPDF', 'Achat::exportRegimesPDF');

// Routes abonnements
$routes->get('/abonnement/acheter', 'Abonnement::acheter');
$routes->post('/abonnement/confirmer', 'Abonnement::confirmer');
$routes->get('/abonnement/detail', 'Abonnement::detail');
