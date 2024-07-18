<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    public function index()
    {
        $data = "Kelas";
        $hover = "Kelas";
        $model = new BarangModel();
        $page = 'kelas';
        $column = ['kode_barang', 'nama_barang', 'satuan', 'merek'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Barang";
        $hover = "Barang";
        $page = "barang";
        $model = new BarangModel();
        $enumValues = $model->getEnumValues('satuan');
        $enum = [
            'satuan' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'kode_barang'],
            ['type' => 'text', 'name' => 'nama_barang'],
            ['type' => 'enum', 'name' => 'satuan'],
            ['type' => 'text', 'name' => 'merek'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'enumValues'));
    }

    public function store()
    {
        $barang = new BarangModel();
        $barang->insert([
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'merek' => $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('barang');
    }

    public function edit($id)
    {
        $data = "Edit Barang";
        $hover = "Barang";
        $page = "barang";
        $model = new BarangModel();
        $enumValues = $model->getEnumValues('satuan');
        $enum = [
            'satuan' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'kode_barang'],
            ['type' => 'text', 'name' => 'nama_barang'],
            ['type' => 'enum', 'name' => 'satuan'],
            ['type' => 'text', 'name' => 'merek'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'enumValues'));
    }
    public function update($id_guru)
    {
        $barang = new BarangModel();
        $barang->update($id_guru, [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'merek' => $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang');
    }

    public function delete($id)
    {
        $barang = new BarangModel();
        $barang->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('barang');
    }

    public function laporan()
    {
        $data = "Laporan Barang";
        $hover = "Laporan Barang";
        $cari = $this->request->getPost('cari');
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('barang/laporan', compact('data', 'hover', 'd_barang', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('barang/cetak', compact('cari'));
    }
}
