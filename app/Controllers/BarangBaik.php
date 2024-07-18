<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangBaikModel;
use App\Models\BarangModel;
use App\Models\BarangSModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangBaik extends BaseController
{
    public function index()
    {
        $data = "Barang baik";
        $hover = "Barang baik";
        $page = "barang_baik";
        $model = new BarangBaikModel();
        $row = $model->getData();
        $hiddenButtonAdd = true;
        $hiddenButtonAction = true;
        $column = ['kode_barang', 'nama_barang', 'status', 'tanggal', 'total', 'biaya'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction'));
    }


    public function laporan()
    {
        $data = "Laporan Barang Baik";
        $hover = "Laporan Barang Baik";
        $data1 = new BarangSModel();
        $dt = $data1->getbarangbaik3();
        return view('barang_baik/laporan', compact('data', 'hover', 'dt'));
    }

    public function cetak()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_baik/cetak', compact('dari', 'sampai'));
    }
}
