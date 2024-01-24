<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
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
        $dt = new BaranmasukModel();
        if(empty($dari)){
            $d_bmp = $dt->getbarang1();
        }else{
            $d_bmp = $dt->getbarang2($dari,$sampai);
        }
        return view('sumber_barang/list',compact('data','hover','d_bmp'));
    }

    public function tambah(){
        $data = "Tambah Sumber Barang";
        $hover = "Sumber Barang";
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('sumber_barang/tambah',compact('data','hover','d_barang'));
    }

    public function store(){
        $data = new BaranmasukModel();
        $data->insert([
            'id_barang'=> $this->request->getPost('id_barang'),
            'tgl'=> $this->request->getPost('tgl'),
            'total'=> $this->request->getPost('total'),
            'harga'=> preg_replace('/[Rp. ]/','',$this->request->getPost('harga')),
            'status'=> $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('sumber_barang');
    }

    public function edit($id){
        $data = "Edit Barang";
        $hover = "Sumber Barang";
        $barangmasuk = new BaranmasukModel();
        $dt = $barangmasuk->where([
            'id_barang_masuk'=>$id,
        ])->first();
        
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id'=> $dt['id_barang']
        ])->first();
        return view('sumber_barang/edit',compact('data','hover','dt','d_barang','dt_barang'));
    }

    public function update($id){
        $data = new BaranmasukModel();
        $data->update($id,[
            'tgl'=> $this->request->getPost('tgl'),
            'total'=> $this->request->getPost('total'),
            'harga'=> preg_replace('/[Rp. ]/','',$this->request->getPost('harga')),
            'status'=> $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('sumber_barang');
    }

    public function delete($id){
        $data = new BaranmasukModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('sumber_barang');
    }

    public function laporan_sumber(){
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getPemerintah();
        return view('sumber_barang/laporan_sumber',compact('data','hover','d_bmp'));
    }

    public function cetak_sumber(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('sumber_barang/cetak_sumber',compact('dari','sampai'));
    }
}
