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

// Routes d'authentification admin
$routes->get('/admin/login', 'Admin\Auth::login');
$routes->post('/admin/auth/authenticate', 'Admin\Auth::authenticate');
$routes->get('/admin/logout', 'Admin\Auth::logout');

// Routes admin - Dashboard
$routes->get('/admin/dashboard', 'Admin\Dashboard::index', ['filter' => 'adminFilter']);

// Routes admin - Régimes
$routes->get('/admin/regime/list', 'Admin\Regime::list', ['filter' => 'adminFilter']);
$routes->get('/admin/regime/create', 'Admin\Regime::create', ['filter' => 'adminFilter']);
$routes->post('/admin/regime/store', 'Admin\Regime::store', ['filter' => 'adminFilter']);
$routes->get('/admin/regime/edit/(:num)', 'Admin\Regime::edit/$1', ['filter' => 'adminFilter']);
$routes->post('/admin/regime/update/(:num)', 'Admin\Regime::update/$1', ['filter' => 'adminFilter']);
$routes->post('/admin/regime/delete/(:num)', 'Admin\Regime::delete/$1', ['filter' => 'adminFilter']);

// Routes admin - Utilisateurs
$routes->get('/admin/utilisateur/list', 'Admin\Utilisateur::list', ['filter' => 'adminFilter']);
$routes->get('/admin/utilisateur/detail/(:num)', 'Admin\Utilisateur::detail/$1', ['filter' => 'adminFilter']);
$routes->post('/admin/utilisateur/toggleGold/(:num)', 'Admin\Utilisateur::toggleGold/$1', ['filter' => 'adminFilter']);

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
