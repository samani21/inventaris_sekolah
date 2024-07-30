<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sekolah extends BaseController
{
    public function index()
    {
        $data = "Sekolah";
        $hover = "Sekolah";
        $model = new SekolahModel();
        $page = 'sekolah';
        $column = ['nama_sekolah', 'alamat', 'kepala_sekolah', 'telepon', 'email'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Sekolah";
        $hover = "Sekolah";
        $page = "sekolah";
        $model = new SekolahModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_sekolah'],
            ['type' => 'textArea', 'name' => 'alamat'],
            ['type' => 'text', 'name' => 'kepala_sekolah'],
            ['type' => 'text', 'name' => 'telepon'],
            ['type' => 'email', 'name' => 'email'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new SekolahModel();
        $data->insert([
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat' => $this->request->getPost('alamat'),
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('sekolah');
    }

    public function edit($id)
    {
        $data = "Edit Sekolah";
        $hover = "Sekolah";
        $page = "sekolah";
        $model = new SekolahModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_sekolah'],
            ['type' => 'textArea', 'name' => 'alamat'],
            ['type' => 'text', 'name' => 'kepala_sekolah'],
            ['type' => 'text', 'name' => 'telepon'],
            ['type' => 'email', 'name' => 'email'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new SekolahModel();
        $data->update($id, [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat' => $this->request->getPost('alamat'),
            'kepala_sekolah' => $this->request->getPost('kepala_sekolah'),
            'telepon' => $this->request->getPost('telepon'),
            'email' => $this->request->getPost('email'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('sekolah');
    }

    public function delete($id)
    {
        $data = new SekolahModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('sekolah');
    }
}
