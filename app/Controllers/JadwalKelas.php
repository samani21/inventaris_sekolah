<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\JadwalKelasModel;
use App\Models\KelasModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalKelas extends BaseController
{
    public function index()
    {
        $data = "Jadwal kelas";
        $hover = "Jadwal kelas";
        $page = 'jadwal_kelas';
        $model = new JadwalKelasModel();
        $row = $model->getData();
        $between = true;
        $column = ['hari', 'jam', 'nama_kelas'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Jadwal kelas";
        $hover = "Jadwal kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $column = ['nama_kelas'];
        $model = new KelasModel();
        $rowKelas = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new JadwalKelasModel();
        $data->insert([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('jadwal_kelas');
    }

    public function edit($id)
    {
        $data = "Edit Jadwal kelas";
        $hover = "Jadwal kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $dt = $model->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')->where([
            'jadwal_kelas.id' => $id,
        ])->select('kelas.nama_kelas,jadwal_kelas.*')->first();

        $column = ['nama_kelas'];
        $modelKelas = new KelasModel();
        $rowKelas = $modelKelas->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
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
