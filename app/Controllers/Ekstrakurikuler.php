<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EkstrakurikulerModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ekstrakurikuler extends BaseController
{
    public function index()
    {
        $data = "Ekstrakurikuler";
        $hover = "Ekstrakurikuler";
        $model = new EkstrakurikulerModel();
        $page = 'ekskul';
        $column = ['kegiatan'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Ekstrakurikuler";
        $hover = "Ekstrakurikuler";
        $page = "ekskul";
        $model = new EkstrakurikulerModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'kegiatan'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new EkstrakurikulerModel();
        $data->insert([
            'kegiatan' => $this->request->getPost('kegiatan'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('ekskul');
    }

    public function edit($id)
    {
        $data = "Edit Ekstrakurikuler";
        $hover = "Ekstrakurikuler";
        $page = "ekskul";
        $model = new EkstrakurikulerModel();
        $enum = [];
        $form = [
            ['type' => 'text', 'name' => 'kegiatan'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new EkstrakurikulerModel();
        $data->update($id, [
            'kegiatan' => $this->request->getPost('kegiatan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('ekskul');
    }

    public function delete($id)
    {
        $data = new EkstrakurikulerModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('ekskul');
    }
}
