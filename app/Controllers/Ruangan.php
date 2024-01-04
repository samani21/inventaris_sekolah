<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class Ruangan extends BaseController
{
    public function index()
    {
        $data = "Ruangan";
        $hover = "Ruangan";
        $barang = new RuanganModel();
        $ruangan = $barang->getRuangan();
        return view('ruangan/list',compact('data','hover','ruangan'));
    }

    public function tambah(){
        $data = "Tambah Ruangan";
        $hover = "Ruangan";
        return view('ruangan/tambah',compact('data','hover'));
    }

    public function store(){
        $barang = new RuanganModel();
        $barang->insert([
            'nm_ruangan'=> $this->request->getPost('nm_ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('ruangan');
    }

    public function edit($id){
        $data = "Edit Ruangan";
        $hover = "Ruangan";
        $barang = new RuanganModel();
        $dt = $barang->where([
            'id_ruangan'=>$id,
        ])->first();
        return view('ruangan/edit',compact('data','hover','dt'));
    }
    public function update($id){
        $ruangan = new RuanganModel();
        $ruangan->update($id,[
            'nm_ruangan'=> $this->request->getPost('nm_ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('ruangan');
    }

    public function delete($id){
        $barang = new RuanganModel();
        $barang->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('ruangan');
    }
}
