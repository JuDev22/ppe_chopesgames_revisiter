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
$routes->get('/','Visiteur::accueil');
$routes->get('jeux','Visiteur::lister_les_produits');
$routes->get('Visiteur/lister_les_produits_par_categorie/(:num)','Visiteur::catById/$1');
$routes->get('categorie/(:alpha)','Visiteur::catByLibelle/$1');
$routes->get('Visteur/lister_les_produits_parmarque/(:num)','Visiteur::marqueById/$1');
$routes->get('marque/(:alpha)','Visiteur::catByLibelle/$1');
$routes->get('connexion','Visiteur::se_connecter');
$routes->get('inscription',"Visiteur::s_enregistrer");
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

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
