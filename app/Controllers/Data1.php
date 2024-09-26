<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Data1Model;
use CodeIgniter\HTTP\ResponseInterface;

class Data1 extends BaseController
{
    public function index()
    {
        $data = "Data1";
        $hover = "Data1";
        $model = new Data1Model();
        $page = 'data1';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Data1";
        $hover = "Data1";
        $page = "data1";
        $model = new Data1Model();
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'textArea', 'name' => 'alamat'],
            ['type' => 'number', 'name' => 'umur'],
            ['type' => 'enum', 'name' => 'agama'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $data = new Data1Model();
        $data->insert([
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tempat' => $this->request->getPost('tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'agama' => $this->request->getPost('agama'),
            'umur' => $this->request->getPost('umur'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('data1');
    }

    public function edit($id)
    {
        $data = "Edit Data1";
        $hover = "Data1";
        $page = "data1";
        $model = new Data1Model();
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'textArea', 'name' => 'alamat'],
            ['type' => 'number', 'name' => 'umur'],
            ['type' => 'enum', 'name' => 'agama'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $data = new Data1Model();
        $data->update($id, [
            'nama' => $this->request->getPost('nama'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tempat' => $this->request->getPost('tempat'),
            'alamat' => $this->request->getPost('alamat'),
            'agama' => $this->request->getPost('agama'),
            'umur' => $this->request->getPost('umur'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('data1');
    }

    public function delete($id)
    {
        $data = new Data1Model();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('data1');
    }

    public function report()
    {
        $data = "Data1";
        $hover = "Data1";
        $model = new Data1Model();
        $page = 'data1';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur'];
        $row = $model->getData();
        $hiddenBetween = true;
        return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
    }

    public function cetak()
    {
        $data = "Data1";
        $hover = "Data1";
        $model = new Data1Model();
        $page = 'data1';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur'];
        $row = $model->getData();
        $hiddenBetween = true;
        return view('laporan/cetak', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
    }
}
