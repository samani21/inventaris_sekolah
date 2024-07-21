<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangBaikModel;
use App\Models\BarangRusakModel;
use App\Models\BaranmasukModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangRusak extends BaseController
{
    public function index()
    {
        $data = "Barang Rusak";
        $hover = "Barang Rusak";
        $page = "barang_rusak";
        $model = new BarangRusakModel();
        $row = $model->getData();
        $verifikasi = true;
        $column = ['kode_barang', 'nama_barang', 'tanggal', 'total', 'keterangan', 'status', 'tanggal_perbaikan', 'total_perbaikan', 'biaya_perbaikan'];
        if (session()->get('level') == "Tata Usaha" || session()->get('level') == "Admin") {
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Barang Rusak";
        $hover = "Barang Rusak";
        $page = "barang_rusak";
        $model = new BaranmasukModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_barang_masuk'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $column = ['kode_barang', 'nama_barang', 'status'];
        $rowBarang = $model->getbarang1();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowBarang,
                'fieldName' => 'id_barang_masuk',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        if ($this->request->getPost('total') < 0) {
            session()->setFlashdata("failed", "Gagal update data cek total dimasukkan");
            return redirect('barang_rusak');
        } else {
            $data = new BarangRusakModel();
            $data->insert([
                'id_barang_masuk' => $this->request->getPost('id_barang_masuk'),
                'tanggal' => $this->request->getPost('tanggal'),
                'total' => $this->request->getPost('total'),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);
            $id_barang_masuk = $this->request->getPost('id_barang_masuk');
            $total = $this->request->getPost('total');
            $modelBarangMasuk = new BaranmasukModel();
            $modelBarangMasuk->kurangStok($id_barang_masuk, $total);
            session()->setFlashdata("success", "Berhasil update data");
            return redirect('barang_rusak');
        }
    }

    public function edit($id)
    {
        $data = "Edit Barang Rusak";
        $hover = "Barang Rusak";
        $page = "barang_rusak";
        $model = new BarangRusakModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_barang_masuk'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $dt = $model->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_rusak.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')->where([
                'barang_rusak.id' => $id,
            ])->select('barang_rusak.*,barang_masuk.id_barang_masuk,barang.kode_barang,barang.nama_barang')->first();

        $column = ['kode_barang', 'nama_barang', 'status'];
        $modelRelasi = new BaranmasukModel();
        $rowBarang = $modelRelasi->getbarang1();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowBarang,
                'fieldName' => 'id_barang_masuk',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $model = new BarangRusakModel();
        $id_barang_masuk = $this->request->getPost('id_barang_masuk');
        $total = $this->request->getPost('total');
        $dt = $model->where('id', $id)->first();
        $totalAwal = $dt['total'];
        if ($total < 0) {
            session()->setFlashdata("failed", "Gagal update data cek total dimasukkan");
            return redirect('barang_rusak');
        } else {
            $model->update($id, [
                'id_barang_masuk' => $this->request->getPost('id_barang_masuk'),
                'total' => $this->request->getPost('total'),
                'tanggal' => $this->request->getPost('tanggal'),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);
            $modelBarangMasuk = new BaranmasukModel();
            $modelBarangMasuk->updateStock($id_barang_masuk, $totalAwal, $total);
            session()->setFlashdata("success", "Berhasil update data");
            return redirect('barang_rusak');
        }
    }

    public function verifikasi($id)
    {
        $data = "Perbaikan Barang";
        $hover = "Perbaikan Barang";
        $page = "barang_rusak";
        $model = new BarangRusakModel();
        $enum = [];
        $formAwal = [
            ['type' => 'relasi', 'name' => 'id_barang_masuk'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $formVerf = [
            ['type' => 'date', 'name' => 'tanggal_diperbaiki'],
            ['type' => 'number', 'name' => 'total_diperbaiki'],
            ['type' => 'number', 'name' => 'biaya_diperbaiki'],
        ];
        $dt = $model->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_rusak.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')->where([
                'barang_rusak.id' => $id,
            ])->select('barang_rusak.*,barang_masuk.id_barang_masuk,barang.kode_barang,barang.nama_barang')->first();

        $column = ['kode_barang', 'nama_barang', 'status'];
        $modelRelasi = new BaranmasukModel();
        $rowBarang = $modelRelasi->getbarang1();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowBarang,
                'fieldName' => 'id_barang_masuk',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];
        $modeVerf = new BarangBaikModel();
        $dtVerf = $modeVerf->where('id_barang_rusak', $id)->select('tanggal as tanggal_diperbaiki,total as total_diperbaiki,biaya as biaya_diperbaiki')->first();
        return view('main/Verifikasi', compact('data', 'hover', 'dt', 'page', 'formAwal', 'enum', 'relasi', 'formVerf', 'dtVerf'));
    }

    public function verifikasiStore($id)
    {
        if ($this->request->getPost('total_diperbaiki') < 0) {
            session()->setFlashdata("failed", "Gagal update data cek total dimasukkan");
            return redirect('barang_rusak');
        } else {
            $modeBarangRusak = new BarangRusakModel();
            $barangRusak = $modeBarangRusak->where([
                'id' => $id,
            ])->first();
            if ($this->request->getPost('total_diperbaiki') > $barangRusak['total']) {
                session()->setFlashdata("failed", "Gagal update data cek total dimasukkan");
                return redirect('barang_rusak');
            } else {
                $ModelBarangBaik = new BarangBaikModel();
                $BarangBaik = $ModelBarangBaik->where('id_barang_rusak', $id)->first();
                if (isset($BarangBaik['id'])) {
                    $total = $this->request->getPost('total_diperbaiki');
                    $id_barang_masuk = $this->request->getPost('id_barang_masuk');
                    $ModelBarangBaik->update($BarangBaik['id'], [
                        'tanggal' => $this->request->getPost('tanggal_diperbaiki'),
                        'total' => $this->request->getPost('total_diperbaiki'),
                        'biaya' => $this->request->getPost('biaya_diperbaiki'),
                    ]);
                    $modelBarangMasuk = new BaranmasukModel();
                    $modelBarangMasuk->updateStockBaik($id_barang_masuk, $BarangBaik['total'], $total);
                } else {
                    $ModelBarangBaik->insert([
                        'id_barang_rusak' => $id,
                        'tanggal' => $this->request->getPost('tanggal_diperbaiki'),
                        'total' => $this->request->getPost('total_diperbaiki'),
                        'biaya' => $this->request->getPost('biaya_diperbaiki'),
                    ]);
                    $id_barang_masuk = $this->request->getPost('id_barang_masuk');
                    $total = $this->request->getPost('total');
                    $modelBarangMasuk = new BaranmasukModel();
                    $modelBarangMasuk->barangBaik($id_barang_masuk, $total);
                }
                session()->setFlashdata("success", "Berhasil update data");
                return redirect('barang_rusak');
            }
        }
    }

    public function delete($id)
    {
        $data = new BarangRusakModel();
        $dt = $data->where('id', $id)->first();
        $modelBarangMasuk = new BaranmasukModel();
        $modelBarangMasuk->deleteStock($dt['id_barang_masuk'], $dt['total']);
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('barang_rusak');
    }

    public function laporan()
    {
        $data = "Laporan Barang Rusak";
        $hover = "Laporan Barang Rusak";
        $data1 = new BarangRusakModel();
        $dt = $data1->getbarangrusakk();
        return view('barang_rusak/laporan', compact('data', 'hover', 'dt'));
    }

    public function cetak()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_rusak/cetak', compact('dari', 'sampai'));
    }
}
