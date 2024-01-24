<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRuanganModel;
use App\Models\BaranmasukModel;
use App\Models\GuruModel;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangPakai extends BaseController
{
    public function index($ruangan)
    {
        $data = "Barang Ruangan ".$ruangan;
        $hover = "Ruangan ".$ruangan;
        $data1 = new BarangRuanganModel();
        $dt = $data1->getPeruangan($ruangan);
        return view('barang_ruangan/list',compact('data','hover','dt'));
    }

    public function tambah($id){
        $data = "Tambah Barang Pakai";
        $hover = "Barang Pakai";
        $barang = new BaranmasukModel();
        $d_barang = $barang->where([
            'id_barang_masuk'=>$id
        ])->first();
        $ruangan = new RuanganModel();
        $ruangan = $ruangan->getRuangan();

        $id_b= $d_barang['id_barang'];
        $barang1 = new BarangModel();
        $d_barang1 = $barang1->where([
            'id'=>$id_b
        ])->first();
        return view('barang_ruangan/tambah',compact('data','hover','d_barang','ruangan','d_barang1'));
    }

    public function store($id){
        $ru = $this->request->getPost('ruangan');
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $id_guru = $guru->where([
            'user_id' =>$id_user,
        ])->first();
        $id_g = $id_guru['id'];
        $data = new BarangRuanganModel();
        $data->insert([
            'id_guru'=> $id_g,
            'id_barang_masuk'=> $id,
            'tgl_pinjam'=> $this->request->getPost('tgl_pinjam'),
            'stok'=> $this->request->getPost('stok'),
            'ruangan'=> $this->request->getPost('ruangan'),
            'status_r'=> 1,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/'.$ru);
    }

    public function selesai($id){
        $data = "Barang Selesai Pakai";
        $hover = "Barang Pakai";
       
        $barag_pakai = new BarangRuanganModel();
        $br = $barag_pakai->where([
            'id_barang_peruangan' => $id,
        ])->first();

        $barang = new BaranmasukModel();
        $d_barang = $barang->where([
            'id_barang_masuk'=>$br['id_barang_masuk']
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id'=>$d_barang['id_barang']
        ])->first();
        return view('barang_ruangan/selesai',compact('data','hover','d_barang','br'));
    }

    public function proses($id){
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $ru = $this->request->getPost('ruangan');
        $id_guru = $guru->where([
            'user_id' =>$id_user,
        ])->first();
        $id_g = $id_guru['id'];
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_selesai'=> $this->request->getPost('tgl_selesai'),
            'stok_selesai'=> $this->request->getPost('stok_selesai'),
            'status_r' => 2,
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/'.$ru);
    }

    public function edit($id){
        $data = "Edit Barang Pakai";
        $hover = "Barang Pakai";
        $barag_pakai = new BarangRuanganModel();
        $br = $barag_pakai->where([
            'id_barang_peruangan' => $id,
        ])->first();

        $barang = new BaranmasukModel();
        $d_barang = $barang->where([
            'id_barang_masuk'=>$br['id_barang_masuk']
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id'=>$d_barang['id_barang']
        ])->first();
        $ruangan = new RuanganModel();
        $ruangan = $ruangan->getRuangan();
        return view('barang_ruangan/edit',compact('data','hover','d_barang','br','ruangan'));
    }

    public function update($id){
        $ru = $this->request->getPost('ruangan');
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_pinjam'=> $this->request->getPost('tgl_pinjam'),
            'stok'=> $this->request->getPost('stok'),
            'ruangan'=> $this->request->getPost('ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/'.$ru);
    }

    public function update1($id){
        $ru = $this->request->getPost('ruangan');
        $data = new BarangRuanganModel();
        $data->update($id,[
            'tgl_selesai'=> $this->request->getPost('tgl_selesai'),
            'stok_selesai'=> $this->request->getPost('stok_selesai'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/'.$ru);
    }

    public function delete($id,$ru){
        $data = new BarangRuanganModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect()->to('barang_peruangan/'.$ru);
    }

    public function laporan_pakai($ruangan)
    {
        $data = "Laporan Barang Ruangan ".$ruangan;
        $hover = "Laporan Barang Ruangan ".$ruangan;
        $data1 = new BarangRuanganModel();
        $dt = $data1->getPakai($ruangan);
        return view('barang_ruangan/laporan_pakai',compact('data','hover','dt','ruangan'));
    }

    public function cetak_pakai(){
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        $ruangan = $this->request->getPost('ruangan');
        return view('barang_ruangan/cetak_pakai',compact('dari','sampai','ruangan'));
    }
}
