<?php

// use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */



// $routes->get('/', 'Auth::login');
// $routes->post('/Auth/loginSubmit', 'Auth::loginSubmit');
// $routes->post('/loginSubmit', 'auth::loginSubmit');
// $routes->get('/auth/logout', 'auth::logout');


// $routes->get('/register', 'Auth::register');
// $routes->post('/registerSubmit', 'Auth::registerSubmit');


// $routes->get('/home', 'Home::index', ['filter' => 'auth']);
// $routes->get('/create', 'Home::create');
// $routes->post('/save', 'Home::save');
// $routes->get('/edit/(:num)', 'Home::edit/$1');
// $routes->post('/update/(:num)', 'Home::update/$1');
// $routes->get('/delete/(:num)', 'Home::delete/$1');

namespace Config;

// Initialize the routing configuration
$routes = Services::routes();

// Rute yang tidak memerlukan login (akses terbuka)
$routes->get('/', 'Auth::login'); // Halaman login
$routes->post('/Auth/loginSubmit', 'Auth::loginSubmit'); // Form login
$routes->get('/register', 'Auth::register'); // Halaman registrasi
$routes->post('/registerSubmit', 'Auth::registerSubmit'); // Proses registrasi

// Rute yang memerlukan login (akses tertutup dengan filter 'auth')
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Rute-rute yang memerlukan login
    $routes->get('/home', 'Home::index'); // Halaman utama setelah login
    $routes->get('/create', 'Home::create'); // Halaman untuk membuat sesuatu
    $routes->post('/save', 'Home::save'); // Proses menyimpan data
    $routes->get('/edit/(:num)', 'Home::edit/$1'); // Halaman edit
    $routes->post('/update/(:num)', 'Home::update/$1'); // Proses update data
    $routes->get('/delete/(:num)', 'Home::delete/$1'); // Proses delete data
});

// Rute untuk logout (akses terbuka)
$routes->get('/auth/logout', 'Auth::logout'); // Halaman logout

