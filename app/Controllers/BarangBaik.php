<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangSModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangBaik extends BaseController
{
    public function index()
    {
        $data = "Barang Baik";
        $hover = "Barang Baik";
        $data1 = new BarangSModel();
        $dt = $data1->getbarangbaik();
        return view('barang_baik/list',compact('data','hover','dt'));
    }

    public function tambah_baik($id){
        $data = "Tambah Barang baik";
        $hover = "Barang Baik";
        $barangmasuk = new BarangsModel();
        $dt = $barangmasuk->where([
            'id_barang_status'=>$id,
        ])->first();
        
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id'=> $dt['id_barang']
        ])->first();
        return view('barang_baik/tambah',compact('data','hover','dt','d_barang','dt_barang'));
    }

    public function store($id){
        $data = new BarangsModel();
        $data->update($id,[
            'tgl_baik'=> $this->request->getPost('tgl_baik'),
            'stok_baik'=> $this->request->getPost('stok_baik'),
            'status'=> 2,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_rusak');
    }

    public function edit($id){
        $data = "Edit Barang baik";
        $hover = "Barang Baik";
        $barangmasuk = new BarangsModel();
        $dt = $barangmasuk->where([
            'id_barang_status'=>$id,
        ])->first();
        
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id'=> $dt['id_barang']
        ])->first();
        return view('barang_baik/tambah',compact('data','hover','dt','d_barang','dt_barang'));
    }

    public function update($id){
        $data = new BarangsModel();
        $data->update($id,[
            'tgl_baik'=> $this->request->getPost('tgl_baik'),
            'stok_baik'=> $this->request->getPost('stok_baik'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_baik');
    }

    public function delete($id){
        $data = new BarangsModel();
        $data->update($id,[
            'stok_baik'=> $this->request->getPost('stok_baik'),
            'status'=> 1,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_baik');
    }

    public function laporan(){
        $data = "Laporan Barang Baik";
        $hover = "Laporan Barang Baik";
        $data1 = new BarangSModel();
        $dt = $data1->getbarangbaik();
        return view('barang_baik/laporan',compact('data','hover','dt'));
    }
    
    public function cetak(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_baik/cetak',compact('dari','sampai'));
    }
}
