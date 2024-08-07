<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EkstrakurikulerModel;
use App\Models\EkstrakurikulerSiswaModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class EkstrakurikulerSiswa extends BaseController
{
    public function index($kegiatan)
    {
        if (session()->get('level') == "Siswa") {
            $namaKegiatan = ucwords(str_replace('_', ' ', $kegiatan));
            $data = $namaKegiatan;
            $hover = $namaKegiatan;
            $model = new EkstrakurikulerSiswaModel();
            $page = 'ekskul/' . $kegiatan;
            $column = ['kegiatan', 'tanggal_bergabung'];
            $ceklist = 'hadir';
            $row = $model->getDataPersiswa($namaKegiatan);
            $hiddenEdit = true;
            // $hiddenButtonAdd = true;
            $foto = true;
            $hadir = true;
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $namaKegiatan = ucwords(str_replace('_', ' ', $kegiatan));
            $data = $namaKegiatan;
            $hover = $namaKegiatan;
            $model = new EkstrakurikulerSiswaModel();
            $page = 'ekskul/' . $kegiatan;
            $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
            $hadirHarian = true;
            $row = $model->getDataEkskul($namaKegiatan);
            $hiddenEdit = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenEdit'));
        }
    }

    public function tambah($kegiatan)
    {
        $data = "Tambah Kegiatan" . $kegiatan . " Siswa";
        $hover = "Tambah Kegiatan " . $kegiatan . " Siswa";
        $page = "ekskul/" . $kegiatan;
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal_bergabung'],
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

    public function store($kegiatan)
    {
        $namakegiatan = ucwords(str_replace('_', ' ', $kegiatan));
        $model = new EkstrakurikulerModel();
        $dataKegiatan = $model->where('kegiatan', $namakegiatan)->first();
        $id_kegiatan = $dataKegiatan['id'];

        $data = new EkstrakurikulerSiswaModel();
        $data->insert([
            'id_siswa' => $this->request->getPost('id_siswa'),
            'id_ekskul' => $id_kegiatan,
            'tanggal_bergabung' => $this->request->getPost('tanggal_bergabung')
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect()->to('/ekstrakurikuler/' . $kegiatan . '');
    }

    public function delete($kelas, $id)
    {
        $data = new EkstrakurikulerSiswaModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect()->back();
    }

    public function reportGuru()
    {
        $data = "Ekstrakurikuler";
        $hover = "Ekstrakurikuler";
        $page = 'ekskul_siswa';
        if (session()->get('level') == "Siswa") {
            $model = new EkstrakurikulerSiswaModel();
            $row = $model->reportDataPersiswa();
        } else {
            $model = new EkstrakurikulerSiswaModel();
            $row = $model->getData();
        }
        $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
        return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function cetakGuru()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Ekstrakurikuler";
        if (session()->get('level') == "Siswa") {
            if ($dari && $sampai) {
                $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
                $model = new EkstrakurikulerSiswaModel();
                $row = $model->cetakBetweenPersiswa($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new EkstrakurikulerSiswaModel();
                $row = $model->cetakDatapersiswa();
                $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
                $model = new EkstrakurikulerSiswaModel();
                $row = $model->cetakBetween($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new EkstrakurikulerSiswaModel();
                $row = $model->getData();
                $column = ['nis', 'nama', 'kegiatan', 'tanggal_bergabung'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }
}
