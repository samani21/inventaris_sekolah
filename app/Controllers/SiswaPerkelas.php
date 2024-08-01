<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenSiswaModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\NilaiUjianModel;
use App\Models\PortofolioProyekModel;
use App\Models\SiswaModel;
use App\Models\SiswaPerkelasModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaPerkelas extends BaseController
{
    protected $idTahunAjaran;
    public function __construct()
    {
        $model = new TahunAjaranModel();
        $tahunAjaran = $model->where('aktif', 1)->first();
        $this->idTahunAjaran = $tahunAjaran['id'];
    }
    public function index($kelas)
    {
        if (session()->get('level') == "Siswa") {
            $tanggal = $this->request->getVar('tanggal');
            $mapel = $this->request->getVar('mapel');
            $namaKelas = ucwords(str_replace('_', ' ', $kelas));
            $data = "Siswa " . $kelas;
            $hover = "Siswa " . $kelas;
            $model = new SiswaPerkelasModel();
            $page = 'siswa/' . $kelas . '/absen_nilai';
            $column = ['nilai', 'kelas', 'mapel', 'materi', 'tanggal','jenis', 'tahun', 'semester'];
            $ceklist = 'hadir';
            $row = $model->getDataPersiswaHarian($namaKelas, $tanggal, $mapel, $this->idTahunAjaran);
            $hiddenEdit = true;
            // $hiddenButtonAdd = true;
            $foto = true;
            $hadir = true;
            $modelMapel = new MapelModel();
            $hiddenButtonAction = true;
            $dtMapel = $modelMapel->getData();
            $hiddenButtonAdd = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'dtMapel', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $tanggal = $this->request->getVar('tanggal');
            $mapel = $this->request->getVar('mapel');
            $namaKelas = ucwords(str_replace('_', ' ', $kelas));
            $data = "Siswa " . $kelas;
            $hover = "Siswa " . $kelas;
            $model = new SiswaPerkelasModel();
            $page = 'siswa/' . $kelas . '/absen_nilai';
            $column = ['nis', 'nama', 'jenis_kelamin', 'kelas'];
            $hadirHarian = true;
            if (isset($tanggal) && isset($mapel)) {
                $ceklist = 'hadir';
                $row = $model->getData($namaKelas, $tanggal, $mapel, $this->idTahunAjaran);
                $hiddenEdit = true;
                // $hiddenButtonAdd = true;
                $foto = true;
                $hadir = true;
                $modelMapel = new MapelModel();
                $dtMapel = $modelMapel->getData();
                return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'ceklist', 'hiddenEdit', 'hadir', 'hadirHarian', 'dtMapel'));
            } else {
                $row = $model->getDataKelas($namaKelas, $this->idTahunAjaran);
                $hiddenEdit = true;
                // $hiddenButtonAdd = true;
                $foto = true;

                $modelMapel = new MapelModel();
                $dtMapel = $modelMapel->getData();
                return view('main/list', compact('data', 'hover', 'row', 'hadirHarian', 'column', 'page', 'foto', 'hiddenEdit', 'dtMapel'));
            }
        }
    }

    public function tambah($kelas)
    {
        $data = "Tambah Siswa " . $kelas;
        $hover = "Siswa " . $kelas;
        $page = "siswa/" . $kelas;
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
        ];
        $columnSiswa = ['nis', 'nama', 'jenis_kelamin'];
        $modelSiswa = new SiswaModel();
        $rowSiswa = $modelSiswa->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $columnSiswa,
                'rows' => $rowSiswa,
                'fieldName' => 'id_siswa',
                'select' => ['nis', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store($kelas)
    {
        $namaKelas = ucwords(str_replace('_', ' ', $kelas));
        $model = new KelasModel();
        $dataKelas = $model->where('nama_kelas', $namaKelas)->first();
        $id_kelas = $dataKelas['id'];

        $data = new SiswaPerkelasModel();
        $data->insert([
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_kelas' => $id_kelas,
            'id_tahun_ajaran' => $this->idTahunAjaran
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect()->to('/siswa_perkelas/' . $kelas . '/absen_nilai');
    }
    public function ceklist($kelas, $id)
    {
        $tanggal = $this->request->getVar('tanggal');
        $mapel = $this->request->getVar('mapel');
        $penilaian = $this->request->getVar('penilaian');
        $materi = $this->request->getVar('materi');
        $modelMapel = new MapelModel();
        $idMapel = $modelMapel->where('nama_mapel', $mapel)->first();
        $data = new AbsenSiswaModel();
        $data->insert([
            'id_siswa_perkelas' => $id,
            'id_tahun_ajaran' => $this->idTahunAjaran,
            'tanggal' => $tanggal,
            'hadir' => 1,
            'id_mapel' => $idMapel['id']
        ]);

        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->back();
    }

    public function nilai($id)
    {
        $tanggal = $this->request->getPost('tanggal');
        $mapel = $this->request->getPost('mapel');
        $penilaian = $this->request->getPost('penilaian');
        $nilai = $this->request->getPost('nilai');
        $materi = $this->request->getPost('materi');
        $data = new NilaiModel();
        $nilaiharian = $data->where('id_absen_siswa', $id)->first();
        $dataProyek = new PortofolioProyekModel();
        $nilaiProyek = $dataProyek->where('id_absen_siswa', $id)->first();
        if (isset($nilaiharian)) {
            $data->update($nilaiharian['id'], [
                'nilai' => $nilai,
            ]);
        } else if (isset($nilaiProyek)) {
            $deskripsi = $this->request->getPost('deskripsi');
            $dataProyek->update($nilaiProyek['id'], [
                'deskripsi' => $deskripsi,
                'nilai' => $nilai,
            ]);
        } else {
            if ($penilaian == "Portofolio dan Proyek") {
                $deskripsi = $this->request->getPost('deskripsi');
                $dataProyek->insert([
                    'id_absen_siswa' => $id,
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'tanggal' => $tanggal,
                    'nilai' => $nilai,
                    'deskripsi' => $deskripsi,
                ]);
            } else {
                $data->insert([
                    'id_absen_siswa' => $id,
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'tanggal' => $tanggal,
                    'nilai' => $nilai,
                    'jenis' => $penilaian,
                    'materi' => $materi,
                ]);
            }
        }

        session()->setFlashdata("success", "Berhasil tambah nilai");
        return redirect()->back();
    }
    public function delete($kelas, $id)
    {
        $data = new SiswaPerkelasModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect()->back();
    }
}
