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
        if (session()->get('level') == "Guru") {
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction'));
        } else {
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
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

    public function report()
    {
        $data = " Cetak Agenda";
        $hover = " Cetak Agenda";
        $page = 'agenda';
        $model = new AgendaModel();
        $row = $model->getData();
        $between = true;
        $column = ['hari', 'tanggal', 'jam', 'kegiatan'];
        return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
    }
    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Persiapan dan Perancanaan Pembelajaran";
        if ($dari && $sampai) {
            $column = ['hari', 'tanggal', 'jam', 'kegiatan'];
            $model = new AgendaModel();
            $row = $model->cetakDataBeetwen($dari, $sampai);
            return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
        } else {
            $model = new AgendaModel();
            $row = $model->getData();
            $column = ['hari', 'tanggal', 'jam', 'kegiatan'];
            return view('laporan/cetak', compact('column', 'row', 'data'));
        }
    }
}
