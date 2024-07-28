<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MetodeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Metode extends BaseController
{
    public function index()
    {
        $data = "Metode";
        $hover = "Metode";
        $model = new MetodeModel();
        $page = 'metode';
        $column = ['metode'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Metode";
        $hover = "Metode";
        $page = "metode";
        $model = new MetodeModel();
        $enum = [];
        $form = [
            ['type' => 'textArea', 'name' => 'metode'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new MetodeModel();
        $data->insert([
            'metode' => $this->request->getPost('metode'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('metode');
    }

    public function edit($id)
    {
        $data = "Edit Metode";
        $hover = "Metode";
        $page = "metode";
        $model = new MetodeModel();
        $enum = [];
        $form = [
            ['type' => 'textArea', 'name' => 'metode'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new MetodeModel();
        $data->update($id, [
            'metode' => $this->request->getPost('metode'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('metode');
    }

    public function delete($id)
    {
        $data = new MetodeModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('metode');
    }
}
