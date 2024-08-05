<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BimbinganKonselingModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class BimbinganKonseling extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Bimbingan dan Konseling";
            $hover = "Bimbingan dan Konseling";
            $page = 'bimbingan_konseling';
            $model = new BimbinganKonselingModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $column = ['tanggal', 'catatan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $data = "Bimbingan dan Konseling";
            $hover = "Bimbingan dan Konseling";
            $page = 'bimbingan_konseling';
            $model = new BimbinganKonselingModel();
            $row = $model->getData();
            $column = ['nis', 'nama', 'tanggal', 'catatan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Bimbingan dan Konseling";
        $hover = "Bimbingan dan Konseling";
        $page = 'bimbingan_konseling';
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'textArea', 'name' => 'catatan'],
        ];
        $column = ['nis', 'nama', 'ttl'];
        $model = new SiswaModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_siswa',
                'select' => ['nis', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new BimbinganKonselingModel();
        $data->insert([
            'id_siswa' => $this->request->getPost('id_siswa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('bimbingan_konseling');
    }

    public function edit($id)
    {
        $data = "Tambah Bimbingan dan Konseling";
        $hover = "Bimbingan dan Konseling";
        $page = 'bimbingan_konseling';
        $model = new BimbinganKonselingModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'textArea', 'name' => 'catatan'],
        ];
        $dt = $model->join('siswa', 'siswa.id=bimbingan_konseling.id_siswa')
            ->where([
                'bimbingan_konseling.id' => $id,
            ])
            ->select('siswa.nama,siswa.nis,bimbingan_konseling.*')->first();

        $column = ['nis', 'nama', 'ttl'];
        $model = new SiswaModel();
        $rowRelasi = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_siswa',
                'select' => ['nis', 'nama']
            ],
        ];

        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new BimbinganKonselingModel();
        $data->update($id, [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'catatan' => $this->request->getPost('catatan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('bimbingan_konseling');
    }

    public function delete($id)
    {
        $data = new BimbinganKonselingModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('bimbingan_konseling');
    }

    public function report()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Bimbingan dan Konseling Siswa";
            $hover = "Bimbingan dan Konseling Siswa";
            $page = 'bimbingan_konseling';
            $model = new BimbinganKonselingModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $column = ['tanggal', 'catatan'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $data = "Bimbingan dan Konseling";
            $hover = "Bimbingan dan Konseling";
            $page = 'bimbingan_konseling';
            $model = new BimbinganKonselingModel();
            $row = $model->getData();
            $column = ['nis', 'nama', 'tanggal', 'catatan'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Bimbingan dan Konseling";
        if (session()->get('level') == "Siswa") {
            if ($dari && $sampai) {
                $column = ['tanggal', 'catatan'];
                $model = new BimbinganKonselingModel();
                $row = $model->cetakDataBeetwenSiswa($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new BimbinganKonselingModel();
                $row = $model->cetakDataPerSiswa();
                $column = ['tanggal', 'catatan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nis', 'nama', 'tanggal', 'catatan'];
                $model = new BimbinganKonselingModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new BimbinganKonselingModel();
                $row = $model->cetakData();
                $column = ['nis', 'nama', 'tanggal', 'catatan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }
}
