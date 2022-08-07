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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');
$routes->post('/location/update/(:any)', 'Location::UpdateLocation/$1');
$routes->get('/location', 'Location::index');
$routes->get('/tes', 'Home::tes');
$routes->get('/chat', 'Chat::index');
$routes->post('/chat/getRoomByUser/(:any)', 'Chat::getRoomByUser/$1');

$routes->get('/mentorchecked', 'Mentor::indexcheck');
$routes->get('/mentor', 'Mentor::index');
$routes->get('/mentor/request', 'Mentor::indexRequestBySiswa');
$routes->get('/mentor/requested', 'Mentor::indexRequestByMentor');
$routes->get('/mentor/request/(:any)', 'Mentor::request/$1');
$routes->post('/mentor/process/(:any)', 'Mentor::process/$1');
$routes->get('/mentor/edit/(:num)', 'Mentor::edit/$1');
$routes->post('/mentor/update/(:num)', 'Mentor::update/$1');
$routes->get('/mentor/delete/(:num)', 'Mentor::delete/$1');
$routes->get('/mentor/verification/(:num)', 'Mentor::verification/$1');

$routes->get('/mylogbook', 'Logbook::index');
$routes->get('/logbook', 'Logbook::indexLogbookAsMentor');

$routes->get('/mylogbook/details/(:any)', 'Logbook::logbook/$1');
$routes->get('/logbook/details/(:any)', 'Logbook::logbookSiswaByMentor/$1');

$routes->get('/logbook/add/(:any)', 'Logbook::add/$1');
$routes->post('/logbook/process/(:any)', 'Logbook::process/$1');
$routes->get('/logbook/edit/(:num)', 'Logbook::edit/$1');
$routes->post('/logbook/update/(:num)', 'Logbook::update/$1');
$routes->get('/logbook/delete/(:num)', 'Logbook::delete/$1');


$routes->get('/profile', 'Profile::index');
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
