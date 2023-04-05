<?php

namespace Config;
use App\Helpers\authHelpers;
use App\Helpers\utilityHelpers;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('manajemenuser', 'Admin::manajemenuser');
    $routes->get('tambahuser', 'Admin::add');
    $routes->post('tambahuser', 'Admin::store');
    $routes->get('edit/(:any)', 'Admin::edit/$1');
    $routes->post('edit', 'Admin::update');
    $routes->post('delete', 'Admin::destroy');
});


$routes->group('manajer', ['filter' => 'authFilter'],  function ($routes) {
    $routes->get('/', 'Manajer::index');

    //pesanan
    $routes->get('pesanan', 'Manajer::pesanan');
    $routes->post('update', 'Manajer::update');

    //produksi
    $routes->get('produksi', 'Manajer::produksi');
    $routes->post('delete', 'Manajer::destroy');
});

$routes->group('ppic', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('/', 'Ppic::index');
    //bahan
    $routes->get('manajemenproduk', 'Ppic::manajemenproduk');
    $routes->get('tambahproduk', 'Ppic::add');
    $routes->post('tambahproduk', 'Ppic::store');
    $routes->get('edit/(:any)', 'Ppic::edit/$1');
    $routes->post('edit', 'Ppic::update');
    $routes->post('delete', 'Ppic::destroy');
   
    //pesanan
    $routes->get('pesanan', 'Ppic::pesanan');
    $routes->get('tambahpesanan', 'Ppic::add_pesanan');
    $routes->post('tambahpesanan', 'Ppic::store_pesanan');
    $routes->get('edit_pesanan/(:any)', 'Ppic::edit_pesanan/$1');
    $routes->post('edit_pesanan', 'Ppic::update_pesanan');
    $routes->post('delete_pesanan', 'Ppic::destroy_pesanan');

});

$routes->group('dyeing', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('/', 'Dyeing::index');
    $routes->get('produksi', 'Dyeing::produksi');
    $routes->post('update', 'Dyeing::update');
    $routes->get('edit/(:any)', 'Dyeing::edit/$1');


});

$routes->group('printing',['filter' => 'authFilter'], function ($routes) {
    $routes->get('/', 'Printing::index');
    $routes->get('produksi', 'Printing::produksi');
    $routes->post('update', 'Printing::update');
    $routes->get('edit/(:any)', 'Printing::edit/$1');


});

$routes->group('finishing',['filter' => 'authFilter'], function ($routes) {
    $routes->get('/', 'Finishing::index');
    $routes->get('produksi', 'Finishing::produksi');
    $routes->post('update', 'Finishing::update');
    $routes->get('edit/(:any)', 'Finishing::edit/$1');


});

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

$routes->get('getDetails', function () {
    return view('getDetails');
});


$routes->get('login', function () {
    if (authHelpers::logged_in()) {
        return redirect()->to(base_url(authHelpers::getRole()));
    }
    return view('auth/login');
});
$routes->post('login', 'AuthControllers::index');
$routes->get('logout', 'AuthControllers::logout');

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
