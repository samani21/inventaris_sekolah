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

//barang
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/tambah', 'Barang::tambah');
$routes->post('barang/store', 'Barang::store');
$routes->get('/barang/edit/(:any)', 'Barang::edit/$1');
$routes->post('/barang/update/(:any)', 'Barang::update/$1');
$routes->get('/barang/delete/(:any)', 'Barang::delete/$1');
$routes->get('/barang/laporan_barang', 'Barang::laporan');
$routes->post('barang/cetak', 'Barang::cetak');

//Tata Usaha
$routes->get('/tata_usaha', 'Guru::index');
$routes->get('/tata_usaha/tambah', 'Guru::tambah');
$routes->post('tata_usaha/store', 'Guru::store');
$routes->get('/tata_usaha/edit/(:any)', 'Guru::edit/$1');
$routes->post('/tata_usaha/update/(:any)', 'Guru::update/$1');
$routes->post('/tata_usaha/profil/(:any)/(:any)', 'Guru::profil/$1/$2');
$routes->get('/tata_usaha/delete/(:any)', 'Guru::delete/$1');
$routes->get('/tata_usaha/laporan', 'Guru::laporan');
$routes->post('tata_usaha/cetak', 'Guru::cetak');

//Kelas
$routes->get('/kelas', 'Kelas::index');
$routes->get('/kelas/tambah', 'Kelas::tambah');
$routes->post('kelas/store', 'Kelas::store');
$routes->get('/kelas/edit/(:any)', 'Kelas::edit/$1');
$routes->post('/kelas/update/(:any)', 'Kelas::update/$1');
$routes->get('/kelas/delete/(:any)', 'Kelas::delete/$1');

//ruangan
$routes->get('/ruangan', 'Ruangan::index');
$routes->get('/ruangan/tambah', 'Ruangan::tambah');
$routes->post('ruangan/store', 'Ruangan::store');
$routes->get('/ruangan/edit/(:any)', 'Ruangan::edit/$1');
$routes->post('/ruangan/update/(:any)', 'Ruangan::update/$1');
$routes->get('/ruangan/delete/(:any)', 'Ruangan::delete/$1');

//tahun ajaran
$routes->get('/tahun_ajaran', 'tahunAjaran::index');
$routes->get('/tahun_ajaran/tambah', 'tahunAjaran::tambah');
$routes->post('tahun_ajaran/store', 'tahunAjaran::store');
$routes->get('/tahun_ajaran/edit/(:any)', 'tahunAjaran::edit/$1');
$routes->post('/tahun_ajaran/update/(:any)', 'tahunAjaran::update/$1');
$routes->get('/tahun_ajaran/ceklist/(:any)', 'tahunAjaran::ceklist/$1');
$routes->get('/tahun_ajaran/delete/(:any)', 'tahunAjaran::delete/$1');

//siswa
$routes->get('/siswa', 'Siswa::index');
$routes->get('/siswa/tambah', 'Siswa::tambah');
$routes->post('siswa/store', 'Siswa::store');
$routes->get('/siswa/edit/(:any)', 'Siswa::edit/$1');
$routes->post('/siswa/update/(:any)', 'Siswa::update/$1');
$routes->post('/siswa/profil/(:any)/(:any)', 'Siswa::profil/$1/$2');
$routes->get('/siswa/delete/(:any)', 'Siswa::delete/$1');
$routes->get('/siswa/laporan', 'Siswa::laporan');
$routes->post('siswa/cetak', 'Siswa::cetak');


//barang masuk
$routes->get('/sumber_barang', 'BarangMasuk::index');
$routes->get('/sumber_barang/tambah', 'BarangMasuk::tambah');
$routes->post('sumber_barang/store', 'BarangMasuk::store');
$routes->get('/sumber_barang/edit/(:any)', 'BarangMasuk::edit/$1');
$routes->post('/sumber_barang/update/(:any)', 'BarangMasuk::update/$1');
$routes->get('/sumber_barang/delete/(:any)', 'BarangMasuk::delete/$1');
$routes->get('/sumber_barang/laporan_sumber', 'BarangMasuk::laporan_sumber');
$routes->post('sumber_barang/cetak_sumber', 'BarangMasuk::cetak_sumber');

//Kondisi_barang
$routes->get('/barang_rusak', 'BarangRusak::index');
$routes->get('/barang_rusak/tambah', 'BarangRusak::tambah');
$routes->post('barang_rusak/store', 'BarangRusak::store');
$routes->get('/barang_rusak/edit/(:any)', 'BarangRusak::edit/$1');
$routes->post('/barang_rusak/update/(:any)', 'BarangRusak::update/$1');
$routes->get('/barang_rusak/verifikasi/(:any)', 'BarangRusak::verifikasi/$1');
$routes->post('/barang_rusak/verifikasi_store/(:any)', 'BarangRusak::verifikasiStore/$1');
$routes->get('/barang_rusak/delete/(:any)', 'BarangRusak::delete/$1');
$routes->get('/barang_rusak/laporan', 'BarangRusak::laporan');
$routes->post('barang_rusak/cetak', 'BarangRusak::cetak');

$routes->get('/barang_baik', 'BarangBaik::index');







//barang baik
$routes->get('/kondisi_barang', 'BarangBaik::index');
$routes->get('/kondisi_barang/tambah', 'BarangBaik::tambah');
$routes->post('kondisi_barang/store', 'BarangBaik::store');
$routes->get('/kondisi_barang/edit/(:any)', 'BarangBaik::edit/$1');
$routes->post('/kondisi_barang/update/(:any)', 'BarangBaik::update/$1');
$routes->get('/kondisi_barang/delete/(:any)', 'BarangBaik::delete/$1');
$routes->get('/kondisi_barang/laporan', 'BarangBaik::laporan');
$routes->post('kondisi_barang/cetak', 'BarangBaik::cetak');

//barang peruangan
$routes->get('/barang_peruangan/(:any)', 'BarangPakai::index/$1');
$routes->get('/barang_pakai/tambah/(:any)', 'BarangPakai::tambah/$1');
$routes->post('barang_pakai/store/(:any)', 'BarangPakai::store/$1');
$routes->get('/barang_pakai/selesai/(:any)', 'BarangPakai::selesai/$1');
$routes->post('barang_pakai/proses/(:any)', 'BarangPakai::proses/$1');
$routes->get('/barang_pakai/edit/(:any)', 'BarangPakai::edit/$1');
$routes->post('/barang_pakai/update/(:any)', 'BarangPakai::update/$1');
$routes->post('/barang_pakai/update1/(:any)', 'BarangPakai::update1/$1');
$routes->get('/barang_pakai/delete/(:any)', 'BarangPakai::delete/$1');
$routes->get('/barang_pakai/laporan_(:any)', 'BarangPakai::laporan_pakai/$1');
$routes->post('barang_pakai/cetak_pakai', 'BarangPakai::cetak_pakai/$1');

//ruangan
$routes->get('/ruangan', 'Ruangan::index');
$routes->get('/ruangan/tambah', 'Ruangan::tambah');
$routes->post('ruangan/store', 'Ruangan::store');
$routes->get('/ruangan/edit/(:any)', 'Ruangan::edit/$1');
$routes->post('/ruangan/update/(:any)', 'Ruangan::update/$1');
$routes->get('/ruangan/delete/(:any)', 'Ruangan::delete/$1');


//profil
$routes->get('/profil', 'Profil::index');
