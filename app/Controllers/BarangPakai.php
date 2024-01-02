<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRuanganModel;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangPakai extends BaseController
{
    public function index()
    {
        $data = "Barang Pakai";
        $hover = "Barang Pakai";
        $data1 = new BarangRuanganModel();
        $dt = $data1->getPeruangan();
        return view('barang_pakai/list',compact('data','hover','dt'));
    }

    public function tambah($id){
        $data = "Tambah Barang Pakai";
        $hover = "Barang Pakai";
        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id'=>$id
        ])->first();
        return view('barang_pakai/tambah',compact('data','hover','d_barang'));
    }

    public function store($id){
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $id_guru = $guru->where([
            'user_id' =>$id_user,
        ])->first();
        $id_g = $id_guru['id'];
        $data = new BarangRuanganModel();
        $data->insert([
            'id_guru'=> $id_g,
            'id_barang'=> $id,
            'tgl_pinjam'=> $this->request->getPost('tgl_pinjam'),
            'stok'=> $this->request->getPost('stok'),
            'ruangan'=> $this->request->getPost('ruangan'),
            'status'=> 1,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_pakai');
    }

    public function selesai($id){
        $data = "Barang Selesai Pakai";
        $hover = "Barang Pakai";
       

        $barag_pakai = new BarangRuanganModel();
        $br = $barag_pakai->where([
            'id_barang_peruangan' => $id,
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id'=>$br['id_barang']
        ])->first();
        return view('barang_pakai/selesai',compact('data','hover','d_barang','br'));
    }

    public function proses($id){
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $id_guru = $guru->where([
            'user_id' =>$id_user,
        ])->first();
        $id_g = $id_guru['id'];
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_selesai'=> $this->request->getPost('tgl_selesai'),
            'stok_selesai'=> $this->request->getPost('stok_selesai'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_pakai');
    }

    public function edit($id){
        $data = "Edit Barang Pakai";
        $hover = "Barang Pakai";
        $barag_pakai = new BarangRuanganModel();
        $br = $barag_pakai->where([
            'id_barang_peruangan' => $id,
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id'=>$br['id_barang']
        ])->first();

        return view('barang_pakai/edit',compact('data','hover','d_barang','br'));
    }

    public function update($id){
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_pinjam'=> $this->request->getPost('tgl_pinjam'),
            'stok'=> $this->request->getPost('stok'),
            'ruangan'=> $this->request->getPost('ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_pakai');
    }

    public function update1($id){
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_selesai'=> $this->request->getPost('tgl_selesai'),
            'stok_selesai'=> $this->request->getPost('stok_selesai'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('barang_pakai');
    }

    public function delete($id){
        $data = new BarangRuanganModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('barang_pakai');
    }
}
