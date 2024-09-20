<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//dashboard
$routes->get('/dashboard', 'Dashboard::index');
//login dan logout
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::doLogin');

//User
$routes->get('/user', 'User::index');
$routes->get('/user/tambah', 'User::tambah');
$routes->post('user/store', 'User::store');
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1');
$routes->get('/user/delete/(:any)', 'User::delete/$1');

//Retribusi parkir
$routes->get('/retribusi_parkir', 'RetribusiParkir::index');
$routes->get('/retribusi_parkir/tambah', 'RetribusiParkir::tambah');
$routes->post('retribusi_parkir/store', 'RetribusiParkir::store');
$routes->get('/retribusi_parkir/edit/(:any)', 'RetribusiParkir::edit/$1');
$routes->post('/retribusi_parkir/update/(:any)', 'RetribusiParkir::update/$1');
$routes->get('/retribusi_parkir/verifikasi/(:any)', 'RetribusiParkir::verifikasi/$1');
$routes->post('/retribusi_parkir/verifikasi_store/(:any)', 'RetribusiParkir::verifikasiStore/$1');
$routes->get('/retribusi_parkir/delete/(:any)', 'RetribusiParkir::delete/$1');
$routes->get('/retribusi_parkir/laporan', 'RetribusiParkir::laporan');
$routes->post('retribusi_parkir/cetak', 'RetribusiParkir::cetak');

//Retribusi parkir
$routes->get('/pengaduan', 'Pengaduan::index');
$routes->get('/pengaduan/tambah', 'Pengaduan::tambah');
$routes->post('pengaduan/store', 'Pengaduan::store');
$routes->get('/pengaduan/edit/(:any)', 'Pengaduan::edit/$1');
$routes->post('/pengaduan/update/(:any)', 'Pengaduan::update/$1');
$routes->post('/pengaduan/profil/(:any)/(:any)', 'Pengaduan::profil/$1/$2');
$routes->get('/pengaduan/delete/(:any)', 'Pengaduan::delete/$1');
$routes->get('/pengaduan/laporan', 'Pengaduan::laporan');
$routes->post('pengaduan/cetak', 'Pengaduan::cetak');
$routes->get('/pengaduan/verifikasi/(:any)', 'Pengaduan::verifikasi/$1');
$routes->post('/pengaduan/verifikasi_store/(:any)', 'Pengaduan::verifikasiStore/$1');

//pegawai
$routes->get('/petugas_parkir', 'PetugasParkir::index');
$routes->get('/petugas_parkir/tambah', 'PetugasParkir::tambah');
$routes->post('petugas_parkir/store', 'PetugasParkir::store');
$routes->get('/petugas_parkir/edit/(:any)', 'PetugasParkir::edit/$1');
$routes->post('/petugas_parkir/update/(:any)', 'PetugasParkir::update/$1');
$routes->post('/petugas_parkir/profil/(:any)/(:any)', 'PetugasParkir::profil/$1/$2');
$routes->get('/petugas_parkir/delete/(:any)', 'PetugasParkir::delete/$1');
$routes->get('/petugas_parkir/laporan', 'PetugasParkir::laporan');
$routes->post('petugas_parkir/cetak', 'PetugasParkir::cetak');

$routes->get('/pegawai', 'Pegawai::index');
$routes->get('/pegawai/tambah', 'Pegawai::tambah');
$routes->post('pegawai/store', 'Pegawai::store');
$routes->get('/pegawai/edit/(:any)', 'Pegawai::edit/$1');
$routes->post('/pegawai/update/(:any)', 'Pegawai::update/$1');
$routes->post('/pegawai/profil/(:any)/(:any)', 'Pegawai::profil/$1/$2');
$routes->get('/pegawai/delete/(:any)', 'Pegawai::delete/$1');
$routes->get('/pegawai/laporan', 'Pegawai::laporan');
$routes->post('pegawai/cetak', 'Pegawai::cetak');

//Tempat parkir
$routes->get('/tempat_parkir', 'TempatParkir::index');
$routes->get('/tempat_parkir/tambah', 'TempatParkir::tambah');
$routes->post('tempat_parkir/store', 'TempatParkir::store');
$routes->get('/tempat_parkir/edit/(:any)', 'TempatParkir::edit/$1');
$routes->post('/tempat_parkir/update/(:any)', 'TempatParkir::update/$1');
$routes->get('/tempat_parkir/delete/(:any)', 'TempatParkir::delete/$1');

//Retribusi parkir
$routes->get('/izin_parkir', 'IzinParkir::index');
$routes->get('/izin_parkir/tambah', 'IzinParkir::tambah');
$routes->post('izin_parkir/store', 'IzinParkir::store');
$routes->get('/izin_parkir/edit/(:any)', 'IzinParkir::edit/$1');
$routes->post('/izin_parkir/update/(:any)', 'IzinParkir::update/$1');
$routes->get('/izin_parkir/delete/(:any)', 'IzinParkir::delete/$1');
$routes->get('/izin_parkir/laporan', 'IzinParkir::laporan');
$routes->post('izin_parkir/cetak', 'IzinParkir::cetak');
$routes->get('/izin_parkir/verifikasi/(:any)', 'IzinParkir::verifikasi/$1');
$routes->post('/izin_parkir/verifikasi_store/(:any)', 'IzinParkir::verifikasiStore/$1');

//profil
$routes->get('/profil', 'Profil::index');
