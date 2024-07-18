<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangSModel;
use CodeIgniter\HTTP\ResponseInterface;

class KondisiBarang extends BaseController
{
    public function index()
    {
        $data = "Kondisi Barang";
        $hover = "Kondisi Barang";
        $model = new BarangSModel();
        $page = 'kondisi_barang';
        $column = ['kode_barang', 'nama_barang', 'tanggal', 'stok', 'keterangan', 'status'];
        $row = $model->getbarang2();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Barang Rusak";
        $hover = "Barang Rusak";
        $page = "kondisi_barang";
        $model = new BarangSModel();
        $enumStatus = $model->getEnumStatus('status');
        $enum = [
            'status' => $enumStatus
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_barang'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'stok'],
            ['type' => 'textArea', 'name' => 'keterangan'],
            ['type' => 'enum', 'name' => 'status'],
        ];
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
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new BarangsModel();
        $data->insert([
            'id_barang' => $this->request->getPost('id_barang'),
            'tgl' => $this->request->getPost('tanggal'),
            'stok' => $this->request->getPost('stok'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kondisi_barang');
    }

    public function edit($id)
    {
        $data = "Edit Barang Rusak";
        $hover = "Barang Rusak";
        $barangmasuk = new BarangsModel();
        $dt = $barangmasuk->where([
            'id_barang_status' => $id,
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id' => $dt['id_barang']
        ])->first();
        return view('barang_rusak/edit', compact('data', 'hover', 'dt', 'd_barang', 'dt_barang'));
    }

    public function update($id)
    {
        $data = new BarangsModel();
        $data->update($id, [
            'tgl_rusak' => $this->request->getPost('tgl_rusak'),
            'stok' => $this->request->getPost('stok'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_rusak');
    }

    public function delete($id)
    {
        $data = new BarangsModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kondisi_barang');
    }

    public function laporan()
    {
        $data = "Laporan Barang Rusak";
        $hover = "Laporan Barang Rusak";
        $data1 = new BarangSModel();
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
