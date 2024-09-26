<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Data1Model;
use App\Models\Data2Model;
use CodeIgniter\HTTP\ResponseInterface;

class Data2 extends BaseController
{
    public function index()
    {
        $data = "Data2";
        $hover = "Data2";
        $model = new Data2Model();
        $page = 'data2';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur', 'jabatan', 'foto'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Data2";
        $hover = "Data2";
        $page = "data2";
        $model = new Data2Model();
        $form = [
            ['type' => 'relasi', 'name' => 'id_data1'],
            ['type' => 'text', 'name' => 'jabatan'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        $column = ['nama', 'tanggal'];
        $model = new Data1Model();
        $rowData1 = $model->getData();
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowData1,
                'fieldName' => 'id_data1',
                'select' => ['nama', 'tanggal']
            ],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'relasi'));
    }

    public function store()
    {
        $dataBerkas = $this->request->getFile('foto');
        $fileName = $dataBerkas->getRandomName();
        $data = new Data2Model();
        $data->insert([
            'id_data1' => $this->request->getPost('id_data1'),
            'jabatan' => $this->request->getPost('jabatan'),
            'foto' => $fileName,
        ]);
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('data2');
    }

    public function edit($id)
    {
        $data = "Edit Data2";
        $hover = "Data2";
        $page = "data2";
        $model = new Data2Model();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_data1'],
            ['type' => 'text', 'name' => 'jabatan'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        $column = ['nama', 'tanggal'];
        $modelData1 = new Data1Model();
        $rowData1 = $modelData1->getData();
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowData1,
                'fieldName' => 'id_data1',
                'select' => ['nama', 'tanggal']
            ],
        ];
        $dt = $model->join('data1', 'data1.id=data2.id_data1')->select('nama,tanggal,data2.*')->where([
            'data2.id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }
    public function update($id)
    {
        $data = new Data2Model();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $data->update($id, [
                'id_data1' => $this->request->getPost('id_data1'),
                'jabatan' => $this->request->getPost('jabatan'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $data->update($id, [
                'id_data1' => $this->request->getPost('id_data1'),
                'jabatan' => $this->request->getPost('jabatan'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('data2');
    }

    public function delete($id)
    {
        $data = new Data2Model();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('data2');
    }

    public function report()
    {
        $data = "Data2";
        $hover = "Data2";
        $model = new Data2Model();
        $page = 'data2';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur', 'jabatan', 'foto'];
        $row = $model->getData();
        $hiddenBetween = true;
        return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
    }

    public function cetak()
    {
        $data = "Data2";
        $hover = "Data2";
        $model = new Data2Model();
        $page = 'data2';
        $column = ['nama', 'tanggal', 'tempat', 'alamat', 'umur', 'jabatan', 'foto'];
        $row = $model->getData();
        $hiddenBetween = true;
        return view('laporan/cetak', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
    }
}
