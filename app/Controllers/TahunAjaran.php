<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class TahunAjaran extends BaseController
{
    public function index()
    {
        $data = "Tahun Ajaran";
        $hover = "Tahun Ajaran";
        $model = new TahunAjaranModel();
        $page = 'tahun_ajaran';
        $column = ['tahun', 'semester'];
        $ceklist = 'aktif';
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'ceklist'));
    }

    public function tambah()
    {
        $data = "Tahun Ajaran";
        $hover = "Tahun Ajaran";
        $page = 'tahun_ajaran';
        $model = new TahunAjaranModel();
        $enum = [];
        $form = [
            ['type' => 'number', 'name' => 'tahun'],
            ['type' => 'number', 'name' => 'semester'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $barang = new TahunAjaranModel();
        $barang->insert([
            'tahun' => $this->request->getPost('tahun'),
            'semester' => $this->request->getPost('semester'),
            'aktif' => 0,
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('tahun_ajaran');
    }

    public function edit($id)
    {
        $data = "Tahun Ajaran";
        $hover = "Tahun Ajaran";
        $page = 'tahun_ajaran';
        $model = new TahunAjaranModel();
        $enum = [];
        $form = [
            ['type' => 'number', 'name' => 'tahun'],
            ['type' => 'number', 'name' => 'semester'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }
    public function update($id)
    {
        $tahunAjaran = new TahunAjaranModel();
        $tahunAjaran->update($id, [
            'tahun' => $this->request->getPost('tahun'),
            'semester' => $this->request->getPost('semester'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('tahun_ajaran');
    }

    public function ceklist($id)
    {
        $model = new TahunAjaranModel();
        $aktif = $model->where('aktif', 1)->first();

        $model->update($aktif['id'], [
            'aktif' => 0
        ]);

        $model->update($id, [
            'aktif' => 1
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('tahun_ajaran');
    }

    public function delete($id)
    {
        $tahunAjaran = new TahunAjaranModel();
        $tahunAjaran->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('tahun_ajaran');
    }
}
