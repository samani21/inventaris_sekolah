<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\BaranmasukModel;
use App\Models\PrestasiSiswaModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class PrestasiSiswa extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Prestasi Siswa";
            $hover = "Prestasi Siswa";
            $page = 'prestasi_siswa';
            $model = new PrestasiSiswaModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $column = ['nis', 'nama', 'tanggal', 'tingkat', 'pencapaian'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $data = "Prestasi Siswa";
            $hover = "Prestasi Siswa";
            $page = 'prestasi_siswa';
            $model = new PrestasiSiswaModel();
            $row = $model->getData();
            $column = ['nis', 'nama', 'tanggal', 'tingkat', 'pencapaian'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Prestasi Siswa";
        $hover = "Prestasi Siswa";
        $page = 'prestasi_siswa';
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tingkat'],
            ['type' => 'text', 'name' => 'pencapaian'],
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
        $data = new PrestasiSiswaModel();
        $data->insert([
            'id_siswa' => $this->request->getPost('id_siswa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tingkat' => $this->request->getPost('tingkat'),
            'pencapaian' => $this->request->getPost('pencapaian'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('prestasi_siswa');
    }

    public function edit($id)
    {
        $data = "Tambah Prestasi Siswa";
        $hover = "Prestasi Siswa";
        $page = 'prestasi_siswa';
        $model = new PrestasiSiswaModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'text', 'name' => 'tingkat'],
            ['type' => 'text', 'name' => 'pencapaian'],
        ];
        $dt = $model->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
            ->where([
                'prestasi_siswa.id' => $id,
            ])
            ->select('siswa.nama,siswa.nis,prestasi_siswa.*')->first();

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
        $data = new PrestasiSiswaModel();
        $data->update($id, [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'tanggal' => $this->request->getPost('tanggal'),
            'tingkat' => $this->request->getPost('tingkat'),
            'pencapaian' => $this->request->getPost('pencapaian'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('prestasi_siswa');
    }

    public function delete($id)
    {
        $data = new PrestasiSiswaModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('prestasi_siswa');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getPemerintah();
        return view('prestasi_siswa/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('prestasi_siswa/cetak_sumber', compact('dari', 'sampai'));
    }
}
