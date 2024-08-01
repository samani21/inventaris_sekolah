<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\InovasiGuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class InovasiGuru extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Inovasi Guru";
            $hover = "Inovasi Guru";
            $page = 'inovasi_guru';
            $model = new InovasiGuruModel();
            $row = $model->getDataPerguru();
            $column = ['tanggal', 'inovasi', 'kreativitas', 'kreativitas', 'profesionalisme', 'masukkan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Inovasi Guru";
            $hover = "Inovasi Guru";
            $page = 'inovasi_guru';
            $model = new InovasiGuruModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $verif = true;
            $column = ['tanggal', 'inovasi', 'kreativitas', 'kreativitas', 'profesionalisme', 'masukkan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd', 'verif'));
        } else {
            $data = "Inovasi Guru";
            $hover = "Inovasi Guru";
            $page = 'inovasi_guru';
            $model = new InovasiGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'inovasi', 'kreativitas', 'kreativitas', 'profesionalisme', 'masukkan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Inovasi Guru";
        $hover = "Inovasi Guru";
        $page = 'inovasi_guru';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'inovasi'],
                ['type' => 'textArea', 'name' => 'kreativitas'],
                ['type' => 'textArea', 'name' => 'etika'],
                ['type' => 'textArea', 'name' => 'profesionalisme'],
                ['type' => 'textArea', 'name' => 'masukkan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'inovasi'],
                ['type' => 'textArea', 'name' => 'kreativitas'],
                ['type' => 'textArea', 'name' => 'etika'],
                ['type' => 'textArea', 'name' => 'profesionalisme'],
                ['type' => 'textArea', 'name' => 'masukkan'],
            ];
        }
        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
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
        $data = new InovasiGuruModel();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'inovasi' => $this->request->getPost('inovasi'),
                'kreativitas' => $this->request->getPost('kreativitas'),
                'etika' => $this->request->getPost('etika'),
                'profesionalisme' => $this->request->getPost('profesionalisme'),
                'masukkan' => $this->request->getPost('masukkan'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'inovasi' => $this->request->getPost('inovasi'),
                'kreativitas' => $this->request->getPost('kreativitas'),
                'etika' => $this->request->getPost('etika'),
                'profesionalisme' => $this->request->getPost('profesionalisme'),
                'masukkan' => $this->request->getPost('masukkan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('inovasi_guru');
    }


    public function edit($id)
    {
        $data = "Edit Inovasi Guru";
        $hover = "Inovasi Guru";
        $page = 'inovasi_guru';
        $model = new InovasiGuruModel();
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'inovasi'],
                ['type' => 'textArea', 'name' => 'kreativitas'],
                ['type' => 'textArea', 'name' => 'etika'],
                ['type' => 'textArea', 'name' => 'profesionalisme'],
                ['type' => 'textArea', 'name' => 'masukkan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'inovasi'],
                ['type' => 'textArea', 'name' => 'kreativitas'],
                ['type' => 'textArea', 'name' => 'etika'],
                ['type' => 'textArea', 'name' => 'profesionalisme'],
                ['type' => 'textArea', 'name' => 'masukkan'],
            ];
        }
        $dt = $model->join('guru', 'guru.id=inovasi_guru.id_guru')
            ->where([
                'inovasi_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,inovasi_guru.*')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
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
        $data = new InovasiGuruModel();
        $data->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'inovasi' => $this->request->getPost('inovasi'),
            'kreativitas' => $this->request->getPost('kreativitas'),
            'etika' => $this->request->getPost('etika'),
            'profesionalisme' => $this->request->getPost('profesionalisme'),
            'masukkan' => $this->request->getPost('masukkan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('inovasi_guru');
    }

    public function verifikasi($id)
    {
        $data = new InovasiGuruModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('inovasi_guru');
    }

    public function delete($id)
    {
        $data = new InovasiGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('inovasi_guru');
    }

    // public function laporan_sumber()
    // {
    //     $data = "Laporan Sumber Barang";
    //     $hover = "Laporan Sumber Barang";
    //     $dt = new InovasiGuruModel();
    //     $d_bmp = $dt->getPemerintah();
    //     return view('inovasi_guru/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    // }

    // public function cetak_sumber()
    // {
    //     $dari = $this->request->getPost('dari');
    //     $sampai = $this->request->getPost('sampai');
    //     return view('inovasi_guru/cetak_sumber', compact('dari', 'sampai'));
    // }
}
