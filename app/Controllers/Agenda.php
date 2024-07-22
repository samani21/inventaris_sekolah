<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\AgendaModel;
use App\Models\KelasModel;
use CodeIgniter\HTTP\ResponseInterface;

class Agenda extends BaseController
{
    public function index()
    {
        $data = "Agenda";
        $hover = "Agenda";
        $page = 'agenda';
        $model = new AgendaModel();
        $row = $model->getData();
        $between = true;
        $column = ['hari', 'tanggal', 'jam', 'kegiatan'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Agenda";
        $hover = "Agenda";
        $page = "agenda";
        $model = new AgendaModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'jam'],
            ['type' => 'textArea', 'name' => 'kegiatan'],
        ];
        $column = ['nama_kelas'];
        $relasi = true;
        $relasi = [];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new AgendaModel();
        $data->insert([
            'tanggal' => $this->request->getPost('tanggal'),
            'hari' => $this->request->getPost('hari'),
            'kegiatan' => $this->request->getPost('kegiatan'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('agenda');
    }

    public function edit($id)
    {
        $data = "Edit Agenda";
        $hover = "Agenda";
        $page = "agenda";
        $model = new AgendaModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'jam'],
            ['type' => 'textArea', 'name' => 'kegiatan'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        $relasi = true;
        $relasi = [];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new AgendaModel();
        $data->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'hari' => $this->request->getPost('hari'),
            'kegiatan' => $this->request->getPost('kegiatan'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('agenda');
    }

    public function delete($id)
    {
        $data = new AgendaModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('agenda');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Agenda";
        $hover = "Laporan Agenda";
        $dt = new AgendaModel();
        $d_bmp = $dt->getPemerintah();
        return view('agenda/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('agenda/cetak_sumber', compact('dari', 'sampai'));
    }
}
