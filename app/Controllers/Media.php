<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MediaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Media extends BaseController
{
    public function index()
    {
        $data = "Media";
        $hover = "Media";
        $model = new MediaModel();
        $page = 'media';
        $column = ['media'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Media";
        $hover = "Media";
        $page = "media";
        $model = new MediaModel();
        $enum = [];
        $form = [
            ['type' => 'textArea', 'name' => 'media'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new MediaModel();
        $data->insert([
            'media' => $this->request->getPost('media'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('media');
    }

    public function edit($id)
    {
        $data = "Edit Media";
        $hover = "Media";
        $page = "media";
        $model = new MediaModel();
        $enum = [];
        $form = [
            ['type' => 'textArea', 'name' => 'media'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new MediaModel();
        $data->update($id, [
            'media' => $this->request->getPost('media'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('media');
    }

    public function delete($id)
    {
        $data = new MediaModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('media');
    }
}
