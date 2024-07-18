<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\BaranmasukModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangMasuk extends BaseController
{
    public function index()
    {
        @$dari = $_GET['dari'];
        @$sampai = $_GET['sampai'];
        $data = "Sumber Barang";
        $hover = "Sumber Barang";
        $page = 'sumber_barang';
        $model = new BaranmasukModel();
        if (empty($dari)) {
            $row = $model->getbarang1();
        } else {
            $row = $model->getbarang2($dari, $sampai);
        }
        $between = true;
        $column = ['kode_barang', 'nama_barang', 'merek', 'tanggal', 'total', 'status'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'between'));
    }

    public function tambah()
    {
        $data = "Tambah Sumber Barang";
        $hover = "Sumber Barang";
        $page = "sumber_barang";
        $model = new BarangModel();
        $enumValues = $model->getEnumValues('satuan');
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_barang'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'text', 'name' => 'status'],
        ];
        $column = ['kode_barang', 'nama_barang', 'satuan', 'merek'];
        $rowBarang = $model->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowBarang,
                'fieldName' => 'id_barang',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new BaranmasukModel();
        $data->insert([
            'id_barang' => $this->request->getPost('id_barang'),
            'tgl' => $this->request->getPost('tanggal'),
            'total' => $this->request->getPost('total'),
            // 'harga' => preg_replace('/[Rp. ]/', '', $this->request->getPost('harga')),
            'status' => $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('sumber_barang');
    }

    public function edit($id)
    {
        $data = "Edit Sumber Barang";
        $hover = "Sumber Barang";
        $page = "sumber_barang";
        $model = new BaranmasukModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_barang'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'text', 'name' => 'status'],
        ];
        $dt = $model->join('barang', 'barang.id=barang_masuk.id_barang')->where([
            'id_barang_masuk' => $id,
        ])->select('id_barang_masuk as id,id_barang,tgl as tanggal,total,status,barang.kode_barang,barang.nama_barang')->first();

        $column = ['kode_barang', 'nama_barang', 'satuan', 'merek'];
        $modelBarang = new BarangModel();
        $rowBarang = $modelBarang->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowBarang,
                'fieldName' => 'id_barang',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new BaranmasukModel();
        $data->update($id, [
            'tgl' => $this->request->getPost('tanggal'),
            'total' => $this->request->getPost('total'),
            'harga' => preg_replace('/[Rp. ]/', '', $this->request->getPost('harga')),
            'status' => $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('sumber_barang');
    }

    public function delete($id)
    {
        $data = new BaranmasukModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('sumber_barang');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getPemerintah();
        return view('sumber_barang/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('sumber_barang/cetak_sumber', compact('dari', 'sampai'));
    }
}
