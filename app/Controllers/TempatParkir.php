<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TempatParkirModel;
use CodeIgniter\HTTP\ResponseInterface;

class TempatParkir extends BaseController
{
    public function index()
    {
        $data = "Tempat Parkir";
        $hover = "Tempat Parkir";
        $model = new TempatParkirModel();
        $page = 'tempat_parkir';
        $column = ['nama_tempat', 'alamat', 'kapasitas_total', 'status'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Tempat Parkir";
        $hover = "Tempat Parkir";
        $page = "tempat_parkir";
        $model = new TempatParkirModel();
        $enumValues = $model->getEnumValues('status_operasional');
        $enum = [
            'status_operasional' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'nama_tempat'],
            ['type' => 'text', 'name' => 'alamat'],
            ['type' => 'number', 'name' => 'kapasitas_total'],
            ['type' => 'enum', 'name' => 'status_operasional'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'enumValues'));
    }

    public function store()
    {
        $tempat_parkir = new TempatParkirModel();
        $tempat_parkir->insert([
            'nama_tempat' => $this->request->getPost('nama_tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'kapasitas_total' => $this->request->getPost('kapasitas_total'),
            'status_operasional' => $this->request->getPost('status_operasional'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('tempat_parkir');
    }

    public function edit($id)
    {
        $data = "Edit Tempat Parkir";
        $hover = "Tempat Parkir";
        $page = "tempat_parkir";
        $model = new TempatParkirModel();
        $enumValues = $model->getEnumValues('status_operasional');
        $enum = [
            'status_operasional' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'nama_tempat'],
            ['type' => 'text', 'name' => 'alamat'],
            ['type' => 'number', 'name' => 'kapasitas_total'],
            ['type' => 'enum', 'name' => 'status_operasional'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'enumValues'));
    }
    public function update($id_guru)
    {
        $tempat_parkir = new TempatParkirModel();
        $tempat_parkir->update($id_guru, [
            'nama_tempat' => $this->request->getPost('nama_tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'kapasitas_total' => $this->request->getPost('kapasitas_total'),
            'status_operasional' => $this->request->getPost('status_operasional'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('tempat_parkir');
    }

    public function delete($id)
    {
        $tempat_parkir = new TempatParkirModel();
        $tempat_parkir->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('tempat_parkir');
    }

    public function laporan()
    {
        $data = "Laporan Tempat Parkir";
        $hover = "Laporan Tempat Parkir";
        $cari = $this->request->getPost('cari');
        $tempat_parkir = new TempatParkirModel();
        $d_tempat_parkir = $tempat_parkir->getBarang();
        return view('tempat_parkir/laporan', compact('data', 'hover', 'd_tempat_parkir', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('tempat_parkir/cetak', compact('cari'));
    }
}
