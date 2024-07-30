<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\JadwalKelasModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalKelas extends BaseController
{
    public function index()
    {
        $data = "Jadwal Kelas";
        $hover = "Jadwal Kelas";
        $page = 'jadwal_kelas';
        $model = new JadwalKelasModel();
        $row = $model->getData();
        $between = true;
        $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Jadwal Kelas";
        $hover = "Jadwal Kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'relasi', 'name' => 'id_mapel'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $column = ['nama_kelas'];
        $model = new KelasModel();
        $rowKelas = $model->getData();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new JadwalKelasModel();
        $data->insert([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('jadwal_kelas');
    }

    public function edit($id)
    {
        $data = "Edit Jadwal Kelas";
        $hover = "Jadwal Kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'relasi', 'name' => 'id_mapel'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $dt = $model->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
            ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')->where([
                'jadwal_kelas.id' => $id,
            ])->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel')->first();

        $column = ['nama_kelas'];
        $model = new KelasModel();
        $rowKelas = $model->getData();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new JadwalKelasModel();
        $data->update($id, [
            'hari' => $this->request->getPost('hari'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('jadwal_kelas');
    }

    public function delete($id)
    {
        $data = new JadwalKelasModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('jadwal_kelas');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Jadwal kelas";
        $hover = "Laporan Jadwal kelas";
        $dt = new JadwalKelasModel();
        $d_bmp = $dt->getPemerintah();
        return view('jadwal_kelas/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('jadwal_kelas/cetak_sumber', compact('dari', 'sampai'));
    }
}
