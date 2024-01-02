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

//barang masuk
$routes->get('/barang_masuk','BarangMasuk::index');
$routes->get('/barang_masuk/tambah','BarangMasuk::tambah');
$routes->post('barang_masuk/store', 'BarangMasuk::store');
$routes->get('/barang_masuk/edit/(:any)', 'BarangMasuk::edit/$1');
$routes->post('/barang_masuk/update/(:any)', 'BarangMasuk::update/$1');
$routes->get('/barang_masuk/delete/(:any)', 'BarangMasuk::delete/$1');

//barang rusal
$routes->get('/barang_rusak','BarangRusak::index');
$routes->get('/barang_rusak/tambah','BarangRusak::tambah');
$routes->post('barang_rusak/store', 'BarangRusak::store');
$routes->get('/barang_rusak/edit/(:any)', 'BarangRusak::edit/$1');
$routes->post('/barang_rusak/update/(:any)', 'BarangRusak::update/$1');
$routes->get('/barang_rusak/delete/(:any)', 'BarangRusak::delete/$1');

//barang baik
$routes->get('/barang_baik','BarangBaik::index');
$routes->get('/barang_baik/tambah/(:any)', 'BarangBaik::tambah_baik/$1');
$routes->post('barang_baik/store/(:any)', 'BarangBaik::store/$1');
$routes->get('/barang_baik/edit/(:any)', 'BarangBaik::edit/$1');
$routes->post('/barang_baik/update/(:any)', 'BarangBaik::update/$1');
$routes->get('/barang_baik/delete/(:any)', 'BarangBaik::delete/$1');

//barang pakai
$routes->get('/barang_pakai','BarangPakai::index');
$routes->get('/barang_pakai/tambah/(:any)','BarangPakai::tambah/$1');
$routes->post('barang_pakai/store/(:any)', 'BarangPakai::store/$1');
$routes->get('/barang_pakai/selesai/(:any)','BarangPakai::selesai/$1');
$routes->post('barang_pakai/proses/(:any)', 'BarangPakai::proses/$1');
$routes->get('/barang_pakai/edit/(:any)', 'BarangPakai::edit/$1');
$routes->post('/barang_pakai/update/(:any)', 'BarangPakai::update/$1');
$routes->post('/barang_pakai/update1/(:any)', 'BarangPakai::update1/$1');
$routes->get('/barang_pakai/delete/(:any)', 'BarangPakai::delete/$1');