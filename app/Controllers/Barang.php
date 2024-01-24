<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    public function index()
    {
        $data = "Barang";
        $hover = "Barang";
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('barang/list',compact('data','hover','d_barang'));
    }

    public function tambah(){
        $data = "Tambah Barang";
        $hover = "Barang";
        return view('barang/tambah',compact('data','hover'));
    }

    public function store(){
        $barang = new BarangModel();
        $barang->insert([
            'nm_barang'=> $this->request->getPost('nm_barang'),
            'satuan'=> $this->request->getPost('satuan'),
            'kode_barang'=> $this->request->getPost('kode_barang'),
            'merek'=> $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang');
    }

    public function edit($id){
        $data = "Edit Barang";
        $hover = "Barang";
        $barang = new BarangModel();
        $dt = $barang->where([
            'id'=>$id,
        ])->first();
        return view('barang/edit',compact('data','hover','dt'));
    }
    public function update($id_guru){
        $barang = new BarangModel();
        $barang->update($id_guru,[
            'nm_barang'=> $this->request->getPost('nm_barang'),
            'satuan'=> $this->request->getPost('satuan'),
            'kode_barang'=> $this->request->getPost('kode_barang'),
            'merek'=> $this->request->getPost('merek'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang');
    }

    public function delete($id){
        $barang = new BarangModel();
        $barang->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('barang');
    }

    public function laporan(){
        $data = "Laporan Barang";
        $hover = "Laporan Barang";
        $cari = $this->request->getPost('cari');
        $barang = new BarangModel();
        $d_barang = $barang->getBarang();
        return view('barang/laporan',compact('data','hover','d_barang','cari'));
    }

    public function cetak(){
        $cari = $this->request->getPost('cari');
        return view('barang/cetak',compact('cari'));
    }
}
