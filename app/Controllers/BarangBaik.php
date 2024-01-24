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
        @$dari = $_GET['dari'];
        @$sampai = $_GET['sampai'];
        @$status = $_GET['status'];
        $data = "Kondisi Barang";
        $hover = "Kondisi Barang";
        $data1 = new BarangSModel();
        if(empty($dari)){
            $dt = $data1->getbarangbaik($dari,$sampai,$status);
        }else{
            $dt = $data1->getbarangbaik1($dari,$sampai,$status);
        }
        return view('kondisi_barang/list',compact('data','hover','dt'));
    }

    public function tambah(){
        $data = "Tambah Barang Rusak";
        $hover = "Barang Rusak";
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('kondisi_barang/tambah',compact('data','hover','d_barang'));
    }

    public function store(){
        $data = new BarangsModel();
        $data->insert([
            'id_barang'=> $this->request->getPost('id_barang'),
            'tgl'=> $this->request->getPost('tgl'),
            'stok'=> $this->request->getPost('stok'),
            'keterangan'=> $this->request->getPost('keterangan'),
            'status'=> 1,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kondisi_barang');
    }

    public function edit($id){
        $data = "Edit Barang baik";
        $hover = "Kondisi Barang";
        $barangmasuk = new BarangsModel();
        $dt = $barangmasuk->where([
            'id_barang_status'=>$id,
        ])->first();
        
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id'=> $dt['id_barang']
        ])->first();
        return view('barang_baik/edit',compact('data','hover','dt','d_barang','dt_barang'));
    }

    public function update($id){
        $data = new BarangsModel();
        $data->update($id,[
            'stok'=> $this->request->getPost('stok'),
            'tgl'=> $this->request->getPost('tgl'),
            'keterangan'=> $this->request->getPost('keterangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kondisi_barang');
    }

    public function delete($id){
        $data = new BarangsModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kondisi_barang');
    }

    public function laporan(){
        $data = "Laporan Barang Baik";
        $hover = "Laporan Barang Baik";
        $data1 = new BarangSModel();
        $dt = $data1->getbarangbaik3();
        return view('barang_baik/laporan',compact('data','hover','dt'));
    }
    
    public function cetak(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_baik/cetak',compact('dari','sampai'));
    }
}
