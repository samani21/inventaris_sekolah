<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ruangan extends BaseController
{
    public function index()
    {
        $data = "Ruangan";
        $hover = "Ruangan";
        $model = new RuanganModel();
        $page = 'ruangan';
        $column = ['nama_ruangan'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Ruangan";
        $hover = "Ruangan";
        $page = "ruangan";
        $model = new RuanganModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_ruangan'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $barang = new RuanganModel();
        $barang->insert([
            'nm_ruangan' => $this->request->getPost('nama_ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('ruangan');
    }

    public function edit($id)
    {
        $data = "Edit Ruangan";
        $hover = "Ruangan";
        $page = "ruangan";
        $model = new RuanganModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'nama_ruangan'],
        ];
        $dt = $model->where([
            'id_ruangan' => $id,
        ])->select('id_ruangan as id,nm_ruangan as nama_ruangan')->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $ruangan = new RuanganModel();
        $ruangan->update($id, [
            'nm_ruangan' => $this->request->getPost('nama_ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('ruangan');
    }

    public function delete($id)
    {
        $barang = new RuanganModel();
        $barang->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('ruangan');
    }
}
