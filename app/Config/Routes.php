<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('kategori', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Kategori::index');
    $routes->get('tambah', 'Kategori::tambah');
    $routes->post('simpan', 'Kategori::simpan');
    $routes->get('edit/(:num)', 'Kategori::edit/$1');
    $routes->post('update/(:num)', 'Kategori::update/$1');
    $routes->get('hapus/(:num)', 'Kategori::hapus/$1');
});

$routes->group('produk', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Produk::index');
    $routes->get('tambah', 'Produk::tambah');
    $routes->post('simpan', 'Produk::simpan');
    $routes->get('edit/(:num)', 'Produk::edit/$1');
    $routes->post('update/(:num)', 'Produk::update/$1');
    $routes->get('hapus/(:num)', 'Produk::hapus/$1');
});

$routes->group('transaksi', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Transaksi::index');
    $routes->post('proses', 'Transaksi::proses');
    $routes->get('struk/(:num)', 'Transaksi::struk/$1');
    $routes->get('riwayat', 'Transaksi::riwayat');
});

$routes->group('laporan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Laporan::index');
    $routes->post('filter', 'Laporan::filter');
});
