<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kelas extends BaseController
{
    public function index()
    {
        $data = "Kelas";
        $hover = "Kelas";
        $model = new KelasModel();
        $page = 'kelas';
        $column = ['nama_kelas'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Kelas";
        $hover = "Kelas";
        $page = "kelas";
        $model = new KelasModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_kelas'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new KelasModel();
        $data->insert([
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('kelas');
    }

    public function edit($id)
    {
        $data = "Edit Kelas";
        $hover = "Kelas";
        $page = "kelas";
        $model = new KelasModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_kelas'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new KelasModel();
        $data->update($id, [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kelas');
    }

    public function delete($id)
    {
        $data = new KelasModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kelas');
    }
}
