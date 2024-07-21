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

$routes->get('/mapel', 'Mapel::index');
$routes->get('/mapel/tambah', 'Mapel::tambah');
$routes->post('mapel/store', 'Mapel::store');
$routes->get('/mapel/edit/(:any)', 'Mapel::edit/$1');
$routes->post('/mapel/update/(:any)', 'Mapel::update/$1');
$routes->get('/mapel/delete/(:any)', 'Mapel::delete/$1');

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

//siswa perkelas
$routes->get('/siswa_perkelas/(:any)', 'SiswaPerkelas::index/$1');
$routes->get('/siswa/(:any)/tambah', 'SiswaPerkelas::tambah/$1');
$routes->post('siswa/(:any)/store', 'SiswaPerkelas::store/$1');
$routes->get('/siswa_perkelas/edit/(:any)', 'SiswaPerkelas::edit/$1');
$routes->post('/siswa_perkelas/update/(:any)', 'SiswaPerkelas::update/$1');
$routes->post('/siswa/nilai/store/(:any)', 'SiswaPerkelas::nilai/$1');
$routes->post('/siswa_perkelas/profil/(:any)/(:any)', 'SiswaPerkelas::profil/$1/$2');
$routes->get('/siswa_perkelas/delete/(:any)', 'SiswaPerkelas::delete/$1');
$routes->get('/siswa/(:any)/ceklist/(:any)', 'SiswaPerkelas::ceklist/$1/$2');
$routes->get('/siswa_perkelas/laporan', 'SiswaPerkelas::laporan');
$routes->post('siswa_perkelas/cetak', 'SiswaPerkelas::cetak');

//siswa Perkelas
$routes->get('/prestasi_siswa', 'PrestasiSiswa::index');
$routes->get('/prestasi_siswa/tambah', 'PrestasiSiswa::tambah');
$routes->post('prestasi_siswa/store', 'PrestasiSiswa::store');
$routes->get('/prestasi_siswa/edit/(:any)', 'PrestasiSiswa::edit/$1');
$routes->post('/prestasi_siswa/update/(:any)', 'PrestasiSiswa::update/$1');
$routes->get('/prestasi_siswa/delete/(:any)', 'PrestasiSiswa::delete/$1');
$routes->get('/prestasi_siswa/laporan_prestasi_siswa', 'PrestasiSiswa::laporan');
$routes->post('prestasi_siswa/cetak', 'PrestasiSiswa::cetak');


//kinerja guru
$routes->get('/kinerja_guru', 'KinerjaGuru::index');
$routes->get('/kinerja_guru/tambah', 'KinerjaGuru::tambah');
$routes->post('kinerja_guru/store', 'KinerjaGuru::store');
$routes->get('/kinerja_guru/edit/(:any)', 'KinerjaGuru::edit/$1');
$routes->post('/kinerja_guru/update/(:any)', 'KinerjaGuru::update/$1');
$routes->post('/kinerja_guru/profil/(:any)/(:any)', 'KinerjaGuru::profil/$1/$2');
$routes->get('/kinerja_guru/delete/(:any)', 'KinerjaGuru::delete/$1');
$routes->get('/kinerja_guru/laporan', 'KinerjaGuru::laporan');
$routes->post('kinerja_guru/cetak', 'KinerjaGuru::cetak');


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
$routes->get('/barang_ruangan/(:any)/tambah', 'BarangPakai::tambah/$1');
$routes->post('barang_ruangan/(:any)/store', 'BarangPakai::store/$1');
$routes->get('barang_ruangan/(:any)/verifikasi/(:any)', 'BarangPakai::verifikasi/$1/$2');
$routes->post('/barang_ruangan/(:any)/verifikasi_store/(:any)', 'BarangPakai::verifikasiStore/$1/$2');


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
