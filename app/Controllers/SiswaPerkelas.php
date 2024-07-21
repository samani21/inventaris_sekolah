<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenSiswaModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\NilaiUjianModel;
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
        $tanggal = $this->request->getVar('tanggal');
        $mapel = $this->request->getVar('mapel');
        $namaKelas = ucwords(str_replace('_', ' ', $kelas));
        $data = "Siswa " . $kelas;
        $hover = "Siswa " . $kelas;
        $model = new SiswaPerkelasModel();
        $page = 'siswa/' . $kelas;
        $column = ['nis', 'nama', 'jenis_kelamin', 'kelas'];
        $ceklist = 'hadir';
        if (isset($tanggal) && isset($mapel)) {
            $row = $model->getData($namaKelas, $tanggal, $mapel, $this->idTahunAjaran);
        } else {
            $row = 1;
        }
        $hiddenEdit = true;
        // $hiddenButtonAdd = true;
        $foto = true;
        $hadir = true;
        $modelMapel = new MapelModel();
        $dtMapel = $modelMapel->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'ceklist', 'hiddenEdit', 'hadir', 'dtMapel'));
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
        return redirect()->to('/siswa_perkelas/' . $kelas);
    }
    public function ceklist($kelas, $id)
    {
        $tanggal = $this->request->getVar('tanggal');
        $mapel = $this->request->getVar('mapel');
        $penilaian = $this->request->getVar('penilaian');
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
        return redirect()->to('/siswa_perkelas/' . $kelas . '?tanggal=' . $tanggal . '&mapel=' . $mapel . '&penilaian=' . $penilaian);
    }

    public function nilai($id)
    {
        $tanggal = $this->request->getPost('tanggal');
        $mapel = $this->request->getPost('mapel');
        $penilaian = $this->request->getPost('penilaian');
        $nilai = $this->request->getPost('nilai');
        if ($penilaian == "Absen dan Nilai") {
            $data = new NilaiModel();
            $data->insert([
                'id_absen_siswa' => $id,
                'id_tahun_ajaran' => $this->idTahunAjaran,
                'tanggal' => $tanggal,
                'nilai' => $nilai,
            ]);
        } else {
            $data = new NilaiUjianModel();
            $data->insert([
                'id_absen_siswa' => $id,
                'id_tahun_ajaran' => $this->idTahunAjaran,
                'tanggal' => $tanggal,
                'nilai' => $nilai,
            ]);
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
