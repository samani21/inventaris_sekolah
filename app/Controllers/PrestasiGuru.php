<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\PrestasiGuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class PrestasiGuru extends BaseController
{
    public function index()
    {
        $data = "Prestasi Guru";
        $hover = "Prestasi Guru";
        $page = 'prestasi_guru';
        $model = new PrestasiGuruModel();
        $row = $model->getData();
        $column = ['nip', 'nama', 'tanggal', 'tingkat', 'pencapaian'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Prestasi Guru";
        $hover = "Prestasi Guru";
        $page = 'prestasi_guru';
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tingkat'],
            ['type' => 'text', 'name' => 'pencapaian'],
        ];
        $column = ['nip', 'nama', 'ttl'];
        $model = new GuruModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PrestasiGuruModel();
        $data->insert([
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tingkat' => $this->request->getPost('tingkat'),
            'pencapaian' => $this->request->getPost('pencapaian'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('prestasi_guru');
    }

    public function edit($id)
    {
        $data = "Tambah Prestasi Siswa";
        $hover = "Prestasi Siswa";
        $page = 'prestasi_guru';
        $model = new PrestasiGuruModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tingkat'],
            ['type' => 'text', 'name' => 'pencapaian'],
        ];
        $dt = $model->join('guru', 'guru.id=prestasi_guru.id_guru')
            ->where([
                'prestasi_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,prestasi_guru.*')->first();

        $column = ['nip', 'nama', 'ttl'];
        $model = new GuruModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];

        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PrestasiGuruModel();
        $data->update($id, [
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tingkat' => $this->request->getPost('tingkat'),
            'pencapaian' => $this->request->getPost('pencapaian'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('prestasi_guru');
    }

    public function delete($id)
    {
        $data = new PrestasiGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('prestasi_guru');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new PrestasiGuruModel();
        $d_bmp = $dt->getPemerintah();
        return view('prestasi_guru/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('prestasi_guru/cetak_sumber', compact('dari', 'sampai'));
    }
}
