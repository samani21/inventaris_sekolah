<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//dashboard
$routes->get('/dashboard','Dashboard::index');
//login dan logout
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::doLogin');

//User
$routes->get('/user','User::index');
$routes->get('/user/tambah', 'User::tambah');
$routes->post('user/store', 'User::store');
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1');
$routes->get('/user/delete/(:any)', 'User::delete/$1');

//Guru
$routes->get('/guru','Guru::index');
$routes->get('/guru/tambah','Guru::tambah');
$routes->post('guru/store', 'Guru::store');
$routes->get('/guru/edit/(:any)', 'Guru::edit/$1');
$routes->post('/guru/update/(:any)', 'Guru::update/$1');
$routes->get('/guru/delete/(:any)', 'Guru::delete/$1');

//barang
$routes->get('/barang','Barang::index');
$routes->get('/barang/tambah','Barang::tambah');
$routes->post('barang/store', 'Barang::store');
$routes->get('/barang/edit/(:any)', 'Barang::edit/$1');
$routes->post('/barang/update/(:any)', 'Barang::update/$1');
$routes->get('/barang/delete/(:any)', 'Barang::delete/$1');

//barang masuk pemerintah
$routes->get('/barang_masuk','BarangMasuk::index');
$routes->get('/barang_masuk/tambah','BarangMasuk::tambah');
$routes->post('barang_masuk/store', 'BarangMasuk::store');
$routes->get('/barang_masuk/edit/(:any)', 'BarangMasuk::edit/$1');
$routes->post('/barang_masuk/update/(:any)', 'BarangMasuk::update/$1');
$routes->get('/barang_masuk/delete/(:any)', 'BarangMasuk::delete/$1');