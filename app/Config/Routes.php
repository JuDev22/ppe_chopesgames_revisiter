<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Visiteur');
$routes->setDefaultMethod('lister_les_produits');
$routes->setTranslateURIDashes(true);
$routes->setAutoRoute(true);
// Would execute the show404 method of the App\Errors class
$routes->set404Override(function( $message = null )
{
    $data = [
        'title' => '404 - Page not found',
        'message' => $message,
    ];
    echo view('my404', $data);
});

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Visiteur::lister_les_produits');
$routes->add('/produit/(:num)', 'Visiteur::lister_les_produits_par_categorie/$1');
$routes->add('/panier', 'Visiteur::afficher_panier/$1');
$routes->get('/connexion', 'Visiteur::se_connecter');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
