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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/komik/create', 'Komik::create');
$routes->get('/komik/(:segment)', 'Komik::detail/$1');  


// project
$routes->get('/auth', 'Login::index');

// profiles all
$routes->get('/profiles/(:segment)/komting', 'Esteh::komting/$1');
$routes->add('/profiles_edit/(:segment)', 'Esteh::edit_profile_komting/$1');
$routes->get('/profiles/(:segment)/laboran', 'Esteh::laboran/$1');
$routes->add('/profiles_edit_laboran/(:segment)', 'Esteh::edit_profile_laboran/$1');

// komting
$routes->get('/ko', 'Komting::index');
$routes->get('/ko/lab/(:segment)', 'Komting::lab/$1'); 
$routes->get('/ko/lab/(:segment)/detail/', 'Komting::detail_lab/$1'); 
$routes->get('/ko/lab/(:segment)/form', 'Komting::form_reservasi_lab/$1');
$routes->add('/abcd/(:segment)/efgh', 'Komting::send_form/$1');

$routes->delete('/re/(:num)', 'Komting::reservasi_del/$1');
$routes->get('/re', 'Komting::reservasi');
$routes->get('/re/(:num)/detail/reservasi', 'Komting::info_reservasi/$1');


// laboran
$routes->get('/lab', 'Laboran::index');
$routes->get('/lab/(:segment)/labor', 'Laboran::lab/$1');
$routes->get('/lab/(:segment)/detail/labor', 'Laboran::detail_lab/$1');
$routes->get('/lab/(:segment)/form/labor', 'Laboran::form_reservasi_lab/$1');
$routes->add('/lab/abcd/(:segment)/efgh', 'Laboran::send_form/$1');
$routes->delete('/lab/(:segment)/delete/booking/(:segment)', 'Laboran::reservasi_del/$1/$2');
$routes->get('/lab/(:segment)/detail/(:num)/info_reservasi', 'Laboran::info_reservasi/$1/$2');  
$routes->add('/lab/(:segment)/(:num)/edit_reservasi/', 'Laboran::edit_reservasi/$1/$2');

$routes->get('/labre', 'Laboran::labor_reservasi');
$routes->delete('/labre/(:num)', 'Laboran::reservasi_del_labre/$1');
$routes->get('/labre/(:num)/detail/reservasi', 'Laboran::info_reservasi_labre/$1');
$routes->add('/labre/(:segment)/(:num)/edit_reservasi/', 'Laboran::edit_reservasi_labre/$1/$2');

$routes->get('/kom/', 'Laboran::komting');
$routes->get('/kom/tmbhkomting', 'Laboran::tmbh_kmtng');
$routes->add('/kom/tmbhkomtingsend', 'Laboran::send_data_kmtng');
$routes->get('/kom/(:segment)/info_komting', 'Laboran::info_komting/$1');
$routes->match(['get', 'post'], '/kom/(:segment)/update_komting/(:num)', 'Laboran::update_komting/$1/$2');
$routes->delete('/kom/(:segment)/hapus_komting', 'Laboran::hapus_komting/$1');
$routes->get('/komd', 'Laboran::dosen');
$routes->get('/komd/(:segment)/info_dosen', 'Laboran::info_dsn/$1');
$routes->match(['get', 'post'], '/komd/(:segment)/update_dosen/(:num)', 'Laboran::update_dosen/$1/$2');
$routes->delete('/komd/(:num)/hapus_dosen', 'Laboran::hapus_dsn/$1');

// dosen
$routes->get('/do', 'Dosen::index');

$routes->get('/lgt', 'Login::lgt');

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
