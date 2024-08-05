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

//ekskul
$routes->get('/ekskul', 'Ekstrakurikuler::index');
$routes->get('/ekskul/tambah', 'Ekstrakurikuler::tambah');
$routes->post('ekskul/store', 'Ekstrakurikuler::store');
$routes->get('/ekskul/edit/(:any)', 'Ekstrakurikuler::edit/$1');
$routes->post('/ekskul/update/(:any)', 'Ekstrakurikuler::update/$1');
$routes->get('/ekskul/delete/(:any)', 'Ekstrakurikuler::delete/$1');

//mapel
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

//Data Sekolah
$routes->get('/sekolah', 'Sekolah::index');
$routes->get('/sekolah/tambah', 'Sekolah::tambah');
$routes->post('sekolah/store', 'Sekolah::store');
$routes->get('/sekolah/edit/(:any)', 'Sekolah::edit/$1');
$routes->post('/sekolah/update/(:any)', 'Sekolah::update/$1');
$routes->get('/sekolah/delete/(:any)', 'Sekolah::delete/$1');


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
$routes->get('/siswa_perkelas/(:any)/absen_nilai', 'SiswaPerkelas::index/$1');
$routes->get('/siswa/(:any)/absen_nilai/tambah', 'SiswaPerkelas::tambah/$1');
$routes->post('siswa/(:any)/absen_nilai/store', 'SiswaPerkelas::store/$1');
$routes->get('/siswa/(:any)/absen_nilai/ceklist/(:any)', 'SiswaPerkelas::ceklist/$1/$2');
$routes->post('/siswa/nilai/absen_nilai/store/(:any)', 'SiswaPerkelas::nilai/$1');
$routes->get('siswa/(:any)/absen_nilai/delete/(:any)', 'SiswaPerkelas::delete/$1/$2');

$routes->get('/siswa_perkelas/edit/(:any)', 'SiswaPerkelas::edit/$1');
$routes->post('/siswa_perkelas/update/(:any)', 'SiswaPerkelas::update/$1');
$routes->post('/siswa_perkelas/profil/(:any)/(:any)', 'SiswaPerkelas::profil/$1/$2');
$routes->get('/siswa_perkelas/delete/(:any)', 'SiswaPerkelas::delete/$1');

$routes->get('/siswa_perkelas/laporan', 'SiswaPerkelas::laporan');
$routes->post('siswa_perkelas/cetak', 'SiswaPerkelas::cetak');

//nilai Semester
$routes->get('/siswa_perkelas/(:any)/ujian', 'UjianSiswa::index/$1');
$routes->get('/siswa/(:any)/ujian/tambah', 'UjianSiswa::tambah/$1');
$routes->post('siswa/(:any)/ujian/store', 'UjianSiswa::store/$1');
$routes->get('/siswa/(:any)/ujian/ceklist/(:any)', 'UjianSiswa::ceklist/$1/$2');
$routes->post('/siswa/nilai/ujian/store/(:any)', 'UjianSiswa::nilai/$1');
$routes->get('siswa/(:any)/ujian/delete/(:any)', 'UjianSiswa::delete/$1/$2');

//ekskul siswa
$routes->get('/ekstrakurikuler/(:any)', 'EkstrakurikulerSiswa::index/$1');
$routes->get('/ekskul/(:any)/tambah', 'EkstrakurikulerSiswa::tambah/$1');
$routes->post('ekskul/(:any)/store', 'EkstrakurikulerSiswa::store/$1');
$routes->get('ekskul/(:any)/delete/(:any)', 'EkstrakurikulerSiswa::delete/$1/$2');

//prestasi siswa
$routes->get('/prestasi_siswa', 'PrestasiSiswa::index');
$routes->get('/prestasi_siswa/tambah', 'PrestasiSiswa::tambah');
$routes->post('prestasi_siswa/store', 'PrestasiSiswa::store');
$routes->get('/prestasi_siswa/edit/(:any)', 'PrestasiSiswa::edit/$1');
$routes->post('/prestasi_siswa/update/(:any)', 'PrestasiSiswa::update/$1');
$routes->get('/prestasi_siswa/delete/(:any)', 'PrestasiSiswa::delete/$1');
$routes->get('/prestasi_siswa/laporan_prestasi_siswa', 'PrestasiSiswa::laporan');
$routes->post('prestasi_siswa/cetak', 'PrestasiSiswa::cetak');


//Bimbingan Konsling siswa
$routes->get('/bimbingan_konseling', 'BimbinganKonseling::index');
$routes->get('/bimbingan_konseling/tambah', 'BimbinganKonseling::tambah');
$routes->post('bimbingan_konseling/store', 'BimbinganKonseling::store');
$routes->get('/bimbingan_konseling/edit/(:any)', 'BimbinganKonseling::edit/$1');
$routes->post('/bimbingan_konseling/update/(:any)', 'BimbinganKonseling::update/$1');
$routes->get('/bimbingan_konseling/delete/(:any)', 'BimbinganKonseling::delete/$1');
$routes->get('/bimbingan_konseling/laporan_bimbingan_konseling', 'BimbinganKonseling::laporan');
$routes->post('bimbingan_konseling/cetak', 'BimbinganKonseling::cetak');


//kinerja guru
$routes->get('/kinerja_guru', 'KinerjaGuru::index');
$routes->get('/kinerja_guru/tambah', 'KinerjaGuru::tambah');
$routes->post('kinerja_guru/store', 'KinerjaGuru::store');
$routes->get('/kinerja_guru/edit/(:any)', 'KinerjaGuru::edit/$1');
$routes->post('/kinerja_guru/update/(:any)', 'KinerjaGuru::update/$1');
$routes->post('/kinerja_guru/profil/(:any)/(:any)', 'KinerjaGuru::profil/$1/$2');
$routes->get('verifikasi/kinerja_guru/(:any)', 'KinerjaGuru::verifikasi/$1');
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
$routes->get('/barang_ruangan/(:any)/delete/(:any)', 'BarangPakai::delete/$1/$2');



$routes->get('/barang_pakai/selesai/(:any)', 'BarangPakai::selesai/$1');
$routes->post('barang_pakai/proses/(:any)', 'BarangPakai::proses/$1');
$routes->get('/barang_pakai/edit/(:any)', 'BarangPakai::edit/$1');
$routes->post('/barang_pakai/update/(:any)', 'BarangPakai::update/$1');
$routes->post('/barang_pakai/update1/(:any)', 'BarangPakai::update1/$1');
$routes->get('/barang_pakai/delete/(:any)', 'BarangPakai::delete/$1');
$routes->get('/barang_pakai/laporan_(:any)', 'BarangPakai::laporan_pakai/$1');
$routes->post('barang_pakai/cetak_pakai', 'BarangPakai::cetak_pakai/$1');

//prestasi guru
$routes->get('/prestasi_guru', 'PrestasiGuru::index');
$routes->get('/prestasi_guru/tambah', 'PrestasiGuru::tambah');
$routes->post('prestasi_guru/store', 'PrestasiGuru::store');
$routes->get('/prestasi_guru/edit/(:any)', 'PrestasiGuru::edit/$1');
$routes->post('/prestasi_guru/update/(:any)', 'PrestasiGuru::update/$1');
$routes->get('/prestasi_guru/delete/(:any)', 'PrestasiGuru::delete/$1');
$routes->get('/prestasi_guru/laporan_prestasi_guru', 'PrestasiGuru::laporan');
$routes->post('prestasi_guru/cetak', 'PrestasiGuru::cetak');

$routes->get('/jadwal_kelas', 'JadwalKelas::index');
$routes->get('/jadwal_kelas/tambah', 'JadwalKelas::tambah');
$routes->post('jadwal_kelas/store', 'JadwalKelas::store');
$routes->get('/jadwal_kelas/edit/(:any)', 'JadwalKelas::edit/$1');
$routes->post('/jadwal_kelas/update/(:any)', 'JadwalKelas::update/$1');
$routes->get('/jadwal_kelas/delete/(:any)', 'JadwalKelas::delete/$1');
$routes->get('/jadwal_kelas/laporan_sumber', 'JadwalKelas::laporan_sumber');
$routes->post('jadwal_kelas/cetak_sumber', 'JadwalKelas::cetak_sumber');


$routes->get('/agenda', 'Agenda::index');
$routes->get('/agenda/tambah', 'Agenda::tambah');
$routes->post('agenda/store', 'Agenda::store');
$routes->get('/agenda/edit/(:any)', 'Agenda::edit/$1');
$routes->post('/agenda/update/(:any)', 'Agenda::update/$1');
$routes->get('/agenda/delete/(:any)', 'Agenda::delete/$1');
$routes->get('/agenda/laporan_sumber', 'Agenda::laporan_sumber');
$routes->post('agenda/cetak_sumber', 'Agenda::cetak_sumber');



//Metode
$routes->get('/metode', 'Metode::index');
$routes->get('/metode/tambah', 'Metode::tambah');
$routes->post('metode/store', 'Metode::store');
$routes->get('/metode/edit/(:any)', 'Metode::edit/$1');
$routes->post('/metode/update/(:any)', 'Metode::update/$1');
$routes->get('/metode/delete/(:any)', 'Metode::delete/$1');

//Media
$routes->get('/media', 'Media::index');
$routes->get('/media/tambah', 'Media::tambah');
$routes->post('media/store', 'Media::store');
$routes->get('/media/edit/(:any)', 'Media::edit/$1');
$routes->post('/media/update/(:any)', 'Media::update/$1');
$routes->get('/media/delete/(:any)', 'Media::delete/$1');


//perancanaa dan persiapan pembelajaran
$routes->get('perancaan_persiapan_pembelajaran', 'PerancanaanPembelajaranPersiapan::index');
$routes->get('perancaan_persiapan_pembelajaran/tambah', 'PerancanaanPembelajaranPersiapan::tambah');
$routes->post('perancaan_persiapan_pembelajaran/store', 'PerancanaanPembelajaranPersiapan::store');
$routes->get('perancaan_persiapan_pembelajaran/edit/(:any)', 'PerancanaanPembelajaranPersiapan::edit/$1');
$routes->get('verifikasi/perancaan_persiapan_pembelajaran/(:any)', 'PerancanaanPembelajaranPersiapan::verifikasi/$1');
$routes->get('reject/perancaan_persiapan_pembelajaran/(:any)', 'PerancanaanPembelajaranPersiapan::reject/$1');
$routes->post('perancaan_persiapan_pembelajaran/update/(:any)', 'PerancanaanPembelajaranPersiapan::update/$1');
$routes->get('perancaan_persiapan_pembelajaran/delete/(:any)', 'PerancanaanPembelajaranPersiapan::delete/$1');

//Pelaksanaan pembelajaran
$routes->get('pelaksanaan_pembelajaran', 'PelaksanaanPembelajaran::index');
$routes->get('pelaksanaan_pembelajaran/tambah', 'PelaksanaanPembelajaran::tambah');
$routes->post('pelaksanaan_pembelajaran/store', 'PelaksanaanPembelajaran::store');
$routes->get('pelaksanaan_pembelajaran/edit/(:any)', 'PelaksanaanPembelajaran::edit/$1');
$routes->post('pelaksanaan_pembelajaran/update/(:any)', 'PelaksanaanPembelajaran::update/$1');
$routes->get('pelaksanaan_pembelajaran/delete/(:any)', 'PelaksanaanPembelajaran::delete/$1');
$routes->get('verifikasi/pelaksanaan_pembelajaran/(:any)', 'PelaksanaanPembelajaran::verifikasi/$1');
$routes->get('reject/pelaksanaan_pembelajaran/(:any)', 'PelaksanaanPembelajaran::reject/$1');

//Pelaksanaan pembelajaran
$routes->get('penilaian_guru', 'SikapPrilakuKedisiplinan::index');
$routes->get('penilaian_guru/tambah', 'SikapPrilakuKedisiplinan::tambah');
$routes->post('penilaian_guru/store', 'SikapPrilakuKedisiplinan::store');
$routes->get('penilaian_guru/edit/(:any)', 'SikapPrilakuKedisiplinan::edit/$1');
$routes->post('penilaian_guru/update/(:any)', 'SikapPrilakuKedisiplinan::update/$1');
$routes->get('penilaian_guru/delete/(:any)', 'SikapPrilakuKedisiplinan::delete/$1');
$routes->get('verifikasi/penilaian_guru/(:any)', 'SikapPrilakuKedisiplinan::verifikasi/$1');
$routes->get('reject/penilaian_guru/(:any)', 'SikapPrilakuKedisiplinan::reject/$1');

//Inovasi guru
$routes->get('inovasi_guru', 'InovasiGuru::index');
$routes->get('inovasi_guru/tambah', 'InovasiGuru::tambah');
$routes->post('inovasi_guru/store', 'InovasiGuru::store');
$routes->get('inovasi_guru/edit/(:any)', 'InovasiGuru::edit/$1');
$routes->post('inovasi_guru/update/(:any)', 'InovasiGuru::update/$1');
$routes->get('inovasi_guru/delete/(:any)', 'InovasiGuru::delete/$1');
$routes->get('verifikasi/inovasi_guru/(:any)', 'InovasiGuru::verifikasi/$1');
$routes->get('reject/inovasi_guru/(:any)', 'InovasiGuru::reject/$1');

//report
$routes->get('perancaan_persiapan_pembelajaran/report', 'PerancanaanPembelajaranPersiapan::report');
$routes->get('perancaan_persiapan_pembelajaran/cetak', 'PerancanaanPembelajaranPersiapan::cetak');
$routes->get('perancaan_persiapan_pembelajaran/cetak_satuan/(:any)', 'PerancanaanPembelajaranPersiapan::cetakSatuan/$1');

$routes->get('pelaksanaan_pembelajaran/report', 'PelaksanaanPembelajaran::report');
$routes->get('pelaksanaan_pembelajaran/cetak', 'PelaksanaanPembelajaran::cetak');
$routes->get('pelaksanaan_pembelajaran/cetak_satuan/(:any)', 'PelaksanaanPembelajaran::cetakSatuan/$1');

$routes->get('penilaian_guru/report', 'SikapPrilakuKedisiplinan::report');
$routes->get('penilaian_guru/cetak', 'SikapPrilakuKedisiplinan::cetak');
$routes->get('penilaian_guru/cetak_satuan/(:any)', 'SikapPrilakuKedisiplinan::cetakSatuan/$1');

$routes->get('inovasi_guru/report', 'InovasiGuru::report');
$routes->get('inovasi_guru/cetak', 'InovasiGuru::cetak');
$routes->get('inovasi_guru/cetak_satuan/(:any)', 'InovasiGuru::cetakSatuan/$1');

$routes->get('jadwal_kelas/report', 'JadwalKelas::report');
$routes->get('jadwal_kelas/cetak', 'JadwalKelas::cetak');

$routes->get('agenda/report', 'Agenda::report');
$routes->get('agenda/cetak', 'Agenda::cetak');

$routes->get('bimbingan_konseling/report', 'BimbinganKonseling::report');
$routes->get('bimbingan_konseling/cetak', 'BimbinganKonseling::cetak');

$routes->get('prestasi_siswa/report', 'PrestasiSiswa::report');
$routes->get('prestasi_siswa/cetak', 'PrestasiSiswa::cetak');

$routes->get('nilai_siswa/report', 'SiswaPerkelas::reportGuru');
$routes->get('nilai_siswa/cetak', 'SiswaPerkelas::cetakGuru');

$routes->get('ekskul_siswa/report', 'EkstrakurikulerSiswa::reportGuru');
$routes->get('ekskul_siswa/cetak', 'EkstrakurikulerSiswa::cetakGuru');

$routes->get('raport_siswa/report', 'SiswaPerkelas::reportSiswa');
$routes->get('raport_siswa/cetak_satuan/(:any)', 'SiswaPerkelas::cetakSiswa/$1');
//profil
$routes->get('/profil', 'Profil::index');
