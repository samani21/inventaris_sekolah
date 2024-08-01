<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\SikapPrilakuKedisiplinanModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SikapPrilakuKedisiplinan extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Penilaian Guru";
            $hover = "Penilaian Guru";
            $page = 'penilaian_guru';
            $model = new SikapPrilakuKedisiplinanModel();
            $row = $model->getDataPerguru();
            $column = ['nip', 'nama', 'tanggal', 'sikap', 'prilaku', 'kedisiplinan', 'masukkan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        } else  if (session()->get('level') == "Kepala Sekolah") {
            $data = "Penilaian Guru";
            $hover = "Penilaian Guru";
            $page = 'penilaian_guru';
            $model = new SikapPrilakuKedisiplinanModel();
            $row = $model->getData();
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $verif = true;
            $column = ['nip', 'nama', 'tanggal', 'sikap', 'prilaku', 'kedisiplinan', 'masukkan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction', 'verif'));
        } else {
            $data = "Penilaian Guru";
            $hover = "Penilaian Guru";
            $page = 'penilaian_guru';
            $model = new SikapPrilakuKedisiplinanModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'sikap', 'prilaku', 'kedisiplinan', 'masukkan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Penilaian Guru";
        $hover = "Penilaian Guru";
        $page = 'penilaian_guru';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'sikap'],
                ['type' => 'textArea', 'name' => 'prilaku'],
                ['type' => 'textArea', 'name' => 'kedisiplinan'],
                ['type' => 'textArea', 'name' => 'masukkan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'sikap'],
                ['type' => 'textArea', 'name' => 'prilaku'],
                ['type' => 'textArea', 'name' => 'kedisiplinan'],
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
        $data = new SikapPrilakuKedisiplinanModel();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'sikap' => $this->request->getPost('sikap'),
                'prilaku' => $this->request->getPost('prilaku'),
                'kedisiplinan' => $this->request->getPost('kedisiplinan'),
                'masukkan' => $this->request->getPost('masukkan'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'sikap' => $this->request->getPost('sikap'),
                'prilaku' => $this->request->getPost('prilaku'),
                'kedisiplinan' => $this->request->getPost('kedisiplinan'),
                'masukkan' => $this->request->getPost('masukkan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('penilaian_guru');
    }


    public function edit($id)
    {
        $data = "Edit Penilaian Guru";
        $hover = "Penilaian Guru";
        $page = 'penilaian_guru';
        $model = new SikapPrilakuKedisiplinanModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'textArea', 'name' => 'sikap'],
            ['type' => 'textArea', 'name' => 'prilaku'],
            ['type' => 'textArea', 'name' => 'kedisiplinan'],
            ['type' => 'textArea', 'name' => 'masukkan'],
        ];
        $dt = $model->join('guru', 'guru.id=sikap_perilaku_kedisiplinan.id_guru')
            ->where([
                'sikap_perilaku_kedisiplinan.id' => $id,
            ])
            ->select('guru.nama,guru.nip,sikap_perilaku_kedisiplinan.*')->first();

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
        $data = new SikapPrilakuKedisiplinanModel();
        $data->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'sikap' => $this->request->getPost('sikap'),
            'prilaku' => $this->request->getPost('prilaku'),
            'kedisiplinan' => $this->request->getPost('kedisiplinan'),
            'masukkan' => $this->request->getPost('masukkan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('penilaian_guru');
    }

    public function verifikasi($id)
    {
        $data = new SikapPrilakuKedisiplinanModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('penilaian_guru');
    }


    public function delete($id)
    {
        $data = new SikapPrilakuKedisiplinanModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('penilaian_guru');
    }

    // public function laporan_sumber()
    // {
    //     $data = "Laporan Sumber Barang";
    //     $hover = "Laporan Sumber Barang";
    //     $dt = new SikapPrilakuKedisiplinanModel();
    //     $d_bmp = $dt->getPemerintah();
    //     return view('penilaian_guru/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    // }

    // public function cetak_sumber()
    // {
    //     $dari = $this->request->getPost('dari');
    //     $sampai = $this->request->getPost('sampai');
    //     return view('penilaian_guru/cetak_sumber', compact('dari', 'sampai'));
    // }
}
