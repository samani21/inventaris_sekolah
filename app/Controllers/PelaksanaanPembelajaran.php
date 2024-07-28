<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MetodeModel;
use App\Models\PelaksanaanPembelajaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class PelaksanaanPembelajaran  extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getData();
            $column = ['nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Pelaksanaan Pembelajaran";
        $hover = "Pelaksanaan Pembelajaran";
        $page = 'pelaksanaan_pembelajaran';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
            ];
        }
        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMetode = ['metode'];
        $modelMetode = new MetodeModel();
        $rowMetode = $modelMetode->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnMetode,
                'rows' => $rowMetode,
                'fieldName' => 'id_metode',
                'select' => ['metode']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PelaksanaanPembelajaranModel();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('pelaksanaan_pembelajaran');
    }


    public function edit($id)
    {
        $data = "Edit Pelaksanaan Pembelajaran";
        $hover = "Pelaksanaan Pembelajaran";
        $page = 'pelaksanaan_pembelajaran';
        $model = new PelaksanaanPembelajaranModel();
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
            ];
        }
        $dt = $model->join('guru', 'guru.id=pelaksanaan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=pelaksanaan_pembelajaran.id_mapel')
            ->join('metode', 'metode.id=pelaksanaan_pembelajaran.id_metode')
            ->where([
                'pelaksanaan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,pelaksanaan_pembelajaran.*,users.level,mapel.nama_mapel,metode')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMetode = ['metode'];
        $modelMetode = new MetodeModel();
        $rowMetode = $modelMetode->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnMetode,
                'rows' => $rowMetode,
                'fieldName' => 'id_metode',
                'select' => ['metode']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $data->update($id, [
            'materi' => $this->request->getPost('materi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_metode' => $this->request->getPost('id_metode'),
            'evaluasi' => $this->request->getPost('evaluasi'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pelaksanaan_pembelajaran');
    }

    public function delete($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('pelaksanaan_pembelajaran');
    }

    // public function laporan_sumber()
    // {
    //     $data = "Laporan Sumber Barang";
    //     $hover = "Laporan Sumber Barang";
    //     $dt = new PelaksanaanPembelajaranModel();
    //     $d_bmp = $dt->getPemerintah();
    //     return view('pelaksanaan_pembelajaran/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    // }

    // public function cetak_sumber()
    // {
    //     $dari = $this->request->getPost('dari');
    //     $sampai = $this->request->getPost('sampai');
    //     return view('pelaksanaan_pembelajaran/cetak_sumber', compact('dari', 'sampai'));
    // }
}
