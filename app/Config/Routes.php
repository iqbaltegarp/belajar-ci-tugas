<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama
$routes->get('/', 'Home::index', ['filter' => 'auth']);

// Auth routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login', ['filter' => 'redirect']);
$routes->get('logout', 'AuthController::logout');

// Produk routes (dilindungi auth)
$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

// Category routes (tanpa filter, bisa ditambahkan jika perlu)
$routes->get('/category', 'Category::index');
$routes->get('/category/create', 'Category::create');
$routes->post('/category/store', 'Category::store');
$routes->get('/category/edit/(:any)', 'Category::edit/$1');
$routes->post('/category/update/(:any)', 'Category::update/$1');
$routes->get('/category/delete/(:any)', 'Category::delete/$1');

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
// Halaman lain (dilindungi auth)
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);
