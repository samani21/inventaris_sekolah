<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KendaraanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kendaraan extends BaseController
{
    public function index()
    {
        $data = "Kendaraan";
        $hover = "Kendaraan";
        $model = new KendaraanModel();
        $page = 'kendaraan';
        $column = ['no_kendaraan', 'jenis', 'merek', 'tipe'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Kendaraan";
        $hover = "Kendaraan";
        $page = "kendaraan";
        $model = new KendaraanModel();
        $enumValues = $model->getEnumValues('jenis');
        $enum = [
            'jenis' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'no_kendaraan'],
            ['type' => 'text', 'name' => 'merek'],
            ['type' => 'text', 'name' => 'tipe'],
            ['type' => 'enum', 'name' => 'jenis'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'enumValues'));
    }

    public function store()
    {
        $kendaraan = new KendaraanModel();
        $kendaraan->insert([
            'tipe' => $this->request->getPost('tipe'),
            'jenis' => $this->request->getPost('jenis'),
            'no_kendaraan' => $this->request->getPost('no_kendaraan'),
            'merek' => $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('kendaraan');
    }

    public function edit($id)
    {
        $data = "Edit Kendaraan";
        $hover = "Kendaraan";
        $page = "kendaraan";
        $model = new KendaraanModel();
        $enumValues = $model->getEnumValues('jenis');
        $enum = [
            'jenis' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'no_kendaraan'],
            ['type' => 'text', 'name' => 'merek'],
            ['type' => 'text', 'name' => 'tipe'],
            ['type' => 'enum', 'name' => 'jenis'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'enumValues'));
    }
    public function update($id_guru)
    {
        $kendaraan = new KendaraanModel();
        $kendaraan->update($id_guru, [
            'tipe' => $this->request->getPost('tipe'),
            'jenis' => $this->request->getPost('jenis'),
            'no_kendaraan' => $this->request->getPost('no_kendaraan'),
            'merek' => $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kendaraan');
    }

    public function delete($id)
    {
        $kendaraan = new KendaraanModel();
        $kendaraan->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kendaraan');
    }

    public function laporan()
    {
        $data = "Laporan Kendaraan";
        $hover = "Laporan Kendaraan";
        $cari = $this->request->getPost('cari');
        $kendaraan = new KendaraanModel();
        $d_kendaraan = $kendaraan->getBarang();
        return view('kendaraan/laporan', compact('data', 'hover', 'd_kendaraan', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('kendaraan/cetak', compact('cari'));
    }
}
