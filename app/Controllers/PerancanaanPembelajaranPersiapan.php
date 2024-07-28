<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MediaModel;
use App\Models\PerancaanPersiapanPembelajaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class PerancanaanPembelajaranPersiapan  extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getData();
            $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Persiapan dan Perancanaan Pembelajaran";
        $hover = "Persiapan dan Perancanaan Pembelajaran";
        $page = 'perancaan_persiapan_pembelajaran';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'text', 'name' => 'media'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        }
        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMedia = ['media'];
        $modelMedia = new MediaModel();
        $rowMedia = $modelMedia->getData();
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
                'columns' => $columnMedia,
                'rows' => $rowMedia,
                'fieldName' => 'id_media',
                'select' => ['media']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_media' => $this->request->getPost('id_media'),
                'tujuan' => $this->request->getPost('tujuan'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_media' => $this->request->getPost('id_media'),
                'tujuan' => $this->request->getPost('tujuan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('perancaan_persiapan_pembelajaran');
    }


    public function edit($id)
    {
        $data = "Edit Persiapan dan Perancanaan Pembelajaran";
        $hover = "Persiapan dan Perancanaan Pembelajaran";
        $page = 'perancaan_persiapan_pembelajaran';
        $model = new PerancaanPersiapanPembelajaranModel();
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relas', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        }
        $dt = $model->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->where([
                'perencanaan_persiapan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMedia = ['media'];
        $modelMedia = new MediaModel();
        $rowMedia = $modelMedia->getData();
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
                'columns' => $columnMedia,
                'rows' => $rowMedia,
                'fieldName' => 'id_media',
                'select' => ['media']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->update($id, [
            'materi' => $this->request->getPost('materi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_media' => $this->request->getPost('id_media'),
            'tujuan' => $this->request->getPost('tujuan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    public function delete($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    // public function laporan_sumber()
    // {
    //     $data = "Laporan Sumber Barang";
    //     $hover = "Laporan Sumber Barang";
    //     $dt = new PerancaanPersiapanPembelajaranModel();
    //     $d_bmp = $dt->getPemerintah();
    //     return view('perancaan_persiapan_pembelajaran/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    // }

    // public function cetak_sumber()
    // {
    //     $dari = $this->request->getPost('dari');
    //     $sampai = $this->request->getPost('sampai');
    //     return view('perancaan_persiapan_pembelajaran/cetak_sumber', compact('dari', 'sampai'));
    // }
}
