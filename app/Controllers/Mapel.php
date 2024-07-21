<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use CodeIgniter\HTTP\ResponseInterface;

class Mapel extends BaseController
{
    public function index()
    {
        $data = "mapel";
        $hover = "mapel";
        $model = new MapelModel();
        $page = 'mapel';
        $column = ['nama_mapel'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Mapel";
        $hover = "Mapel";
        $page = "mapel";
        $model = new MapelModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_mapel'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new MapelModel();
        $data->insert([
            'nama_mapel' => $this->request->getPost('nama_mapel'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('mapel');
    }

    public function edit($id)
    {
        $data = "Edit Mapel";
        $hover = "Mapel";
        $page = "mapel";
        $model = new MapelModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_mapel'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new MapelModel();
        $data->update($id, [
            'nama_mapel' => $this->request->getPost('nama_mapel'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('mapel');
    }

    public function delete($id)
    {
        $data = new MapelModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('mapel');
    }
}
