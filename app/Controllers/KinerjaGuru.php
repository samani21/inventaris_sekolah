<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\KinerjaGuruModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class KinerjaGuru extends BaseController
{
    public function index()
    {
        $data = "Kinerja Guru";
        $hover = "Kinerja Guru";
        $page = 'kinerja_guru';
        $model = new KinerjaGuruModel();
        $row = $model->getData();
        $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Kinerja Guru";
        $hover = "Kinerja Guru";
        $page = 'kinerja_guru';
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'kompetensi_pedagogik'],
            ['type' => 'number', 'name' => 'kompetensi_kepribadian'],
            ['type' => 'number', 'name' => 'kompetensi_profesional'],
            ['type' => 'number', 'name' => 'kompetensi_sosial'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $column = ['nip', 'nama', 'ttl'];
        $model = new GuruModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new KinerjaGuruModel();
        $data->insert([
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
            'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
            'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
            'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('kinerja_guru');
    }


    public function edit($id)
    {
        $data = "Edit Kinerja Guru";
        $hover = "Kinerja Guru";
        $page = 'kinerja_guru';
        $model = new KinerjaGuruModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'kompetensi_pedagogik'],
            ['type' => 'number', 'name' => 'kompetensi_kepribadian'],
            ['type' => 'number', 'name' => 'kompetensi_profesional'],
            ['type' => 'number', 'name' => 'kompetensi_sosial'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $dt = $model->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->where([
                'kinerja_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,kinerja_guru.*')->first();

        $column = ['nip', 'nama', 'ttl'];
        $model = new GuruModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new KinerjaGuruModel();
        $data->update($id, [
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
            'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
            'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
            'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kinerja_guru');
    }

    public function delete($id)
    {
        $data = new KinerjaGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kinerja_guru');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new KinerjaGuruModel();
        $d_bmp = $dt->getPemerintah();
        return view('kinerja_guru/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('kinerja_guru/cetak_sumber', compact('dari', 'sampai'));
    }
}
