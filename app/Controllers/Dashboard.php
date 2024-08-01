<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\InovasiGuruModel;
use App\Models\PelaksanaanPembelajaranModel;
use App\Models\PerancaanPersiapanPembelajaranModel;
use App\Models\SikapPrilakuKedisiplinanModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $idTahunAjaran;
    public function __construct()
    {
        $model = new TahunAjaranModel();
        $tahunAjaran = $model->where('aktif', 1)->first();
        $this->idTahunAjaran = $tahunAjaran['id'];
    }

    public function index()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Dashboard";
            $hover = "Dashboard";
            $page = "dashboard";
            $id_user = session()->get('id');
            $guru = new GuruModel();
            $dt = $guru->where([
                'user_id' => $id_user,
            ])->first();
            return view('dashboard/index', compact('data', 'hover', 'page'));
        } else if (session()->get('level') == "Guru") {
            $db = \Config\Database::connect();
            $querySiswa = $db->query('SELECT COUNT(nis) as jumlah FROM `siswa` ');
            $rowSIswa = $querySiswa->getRow();
            $jumlahSiSwa = $rowSIswa->jumlah;

            $querySiswaPerkelas = $db->query('SELECT COUNT(tahun_ajaran.id) as jumlah FROM `siswa_perkelas` JOIN siswa ON siswa.id = siswa_perkelas.id_siswa JOIN tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran WHERE tahun_ajaran.id = ' . $this->idTahunAjaran . '');
            $rowSIswaPerkelas = $querySiswaPerkelas->getRow();
            $jumlahSiSwaPerkelas = $rowSIswaPerkelas->jumlah;

            $queryGuru = $db->query('SELECT count(nip) as jumlah FROM `guru` JOIN users ON users.id = guru.user_id WHERE level ="Guru"');
            $rowGuru = $queryGuru->getRow();
            $jumlahGuru = $rowGuru->jumlah;

            $queryTataUsaha = $db->query('SELECT count(nip) as jumlah FROM `guru` JOIN users ON users.id = guru.user_id WHERE level ="Tata Usaha"');
            $rowTataUsaha = $queryTataUsaha->getRow();
            $jumlahTataUsaha = $rowTataUsaha->jumlah;

            $data = "Dashboard";
            $hover = "Dashboard";
            $page = "dashboard";
            $id_user = session()->get('id');
            $guru = new GuruModel();
            $dt = $guru->where([
                'user_id' => $id_user,
            ])->first();
            $modelPerancanaan = new PerancaanPersiapanPembelajaranModel();
            $perancanaan = count($modelPerancanaan->getChart());

            $modelPelaksanaan = new PelaksanaanPembelajaranModel();
            $pelaksanaan = count($modelPelaksanaan->getChart());

            $modelSikap = new SikapPrilakuKedisiplinanModel();
            $sikap = count($modelSikap->getChart());

            $modelInovasi = new InovasiGuruModel();
            $inovasi = count($modelInovasi->getChart());

            return view('dashboard/index', compact('data', 'hover', 'page', 'jumlahSiSwa', 'jumlahSiSwaPerkelas', 'jumlahGuru', 'jumlahTataUsaha', 'perancanaan', 'pelaksanaan', 'sikap', 'inovasi'));
        } else {
            $db = \Config\Database::connect();
            $querySiswa = $db->query('SELECT COUNT(nis) as jumlah FROM `siswa` ');
            $rowSIswa = $querySiswa->getRow();
            $jumlahSiSwa = $rowSIswa->jumlah;

            $querySiswaPerkelas = $db->query('SELECT COUNT(tahun_ajaran.id) as jumlah FROM `siswa_perkelas` JOIN siswa ON siswa.id = siswa_perkelas.id_siswa JOIN tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran WHERE tahun_ajaran.id = ' . $this->idTahunAjaran . '');
            $rowSIswaPerkelas = $querySiswaPerkelas->getRow();
            $jumlahSiSwaPerkelas = $rowSIswaPerkelas->jumlah;

            $queryGuru = $db->query('SELECT count(nip) as jumlah FROM `guru` JOIN users ON users.id = guru.user_id WHERE level ="Guru"');
            $rowGuru = $queryGuru->getRow();
            $jumlahGuru = $rowGuru->jumlah;

            $queryTataUsaha = $db->query('SELECT count(nip) as jumlah FROM `guru` JOIN users ON users.id = guru.user_id WHERE level ="Tata Usaha"');
            $rowTataUsaha = $queryTataUsaha->getRow();
            $jumlahTataUsaha = $rowTataUsaha->jumlah;

            $data = "Dashboard";
            $hover = "Dashboard";
            $page = "dashboard";
            $id_user = session()->get('id');
            $guru = new GuruModel();
            $dt = $guru->where([
                'user_id' => $id_user,
            ])->first();
            return view('dashboard/index', compact('data', 'hover', 'page', 'jumlahSiSwa', 'jumlahSiSwaPerkelas', 'jumlahGuru', 'jumlahTataUsaha'));
        }
    }
}
