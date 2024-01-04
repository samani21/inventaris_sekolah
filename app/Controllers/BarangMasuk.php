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
        $data = "Barang Masuk";
        $hover = "Barang Masuk";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getbarang1();
        return view('barang_masuk/list',compact('data','hover','d_bmp'));
    }

    public function tambah(){
        $data = "Tambah Barang Masuk";
        $hover = "Barang Masuk";
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('barang_masuk/tambah',compact('data','hover','d_barang'));
    }

    public function store(){
        $id_barang = substr($this->request->getPost('id_barang'),0,4);
        $data = new BaranmasukModel();
        $data->insert([
            'id_barang'=> $id_barang,
            'tgl'=> $this->request->getPost('tgl'),
            'total'=> $this->request->getPost('total'),
            'harga'=> preg_replace('/[Rp. ]/','',$this->request->getPost('harga')),
            'status'=> $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_masuk');
    }

    public function edit($id){
        $data = "Edit Barang";
        $hover = "Barang Masuk";
        $barangmasuk = new BaranmasukModel();
        $dt = $barangmasuk->where([
            'id_barang_masuk'=>$id,
        ])->first();
        
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        $dt_barang = $barang->where([
            'id'=> $dt['id_barang']
        ])->first();
        return view('barang_masuk/edit',compact('data','hover','dt','d_barang','dt_barang'));
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
        return redirect('barang_masuk');
    }

    public function delete($id){
        $data = new BaranmasukModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('barang_masuk');
    }

    public function laporan_pemerintah(){
        $data = "Barang Masuk Pemerintah";
        $hover = "Barang Masuk Pemerintah";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getPemerintah();
        return view('barang_masuk/laporan_pemerintah',compact('data','hover','d_bmp'));
    }

    public function cetak_pemerintah(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_masuk/cetak_pemerintah',compact('dari','sampai'));
    }

    public function laporan_pembelian(){
        $data = "Barang Masuk Pembelian";
        $hover = "Barang Masuk Pembelian";
        $dt = new BaranmasukModel();
        $d_bmp = $dt->getPembelian();
        return view('barang_masuk/laporan_pembelian',compact('data','hover','d_bmp'));
    }

    public function cetak_pembelian(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('barang_masuk/cetak_pembelian',compact('dari','sampai'));
    }
}
