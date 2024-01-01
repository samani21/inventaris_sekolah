<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class Guru extends BaseController
{
    public function index()
    {
        $data = "Guru";
        $hover = "Guru";
        $guru = new GuruModel();
        $d_guru = $guru->getGUru();
        return view('guru/list',compact('data','d_guru','hover'));
    }

    public function tambah(){
        $data = "Tambah Data Guru";
        $hover = "Guru";
        return view('guru/tambah',compact('data','hover'));
    }

    public function store(){
        $guru = new GuruModel();
        $guru->insert([
            'user_id'=>$this->request->getPost('user_id'),
            'nip'=>$this->request->getPost('nip'),
            'nama'=>$this->request->getPost('nama'),
            'tempat'=>$this->request->getPost('tempat'),
            't_lahir'=>$this->request->getPost('t_lahir'),
            'j_kelamin'=>$this->request->getPost('j_kelamin'),
            'agama'=>$this->request->getPost('agama'),
            'no_hp'=>$this->request->getPost('no_hp'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('dashboard');
    }

    public function edit($id){
        $data = "Edit Guru";
        $hover = "Pengguna";
        $user = new GuruModel();
        $dt = $user->where([
            'id'=>$id,
        ])->first();
        return view('guru/edit',compact('data','hover','dt'));
    }

    public function update($id_guru){
        $guru = new GuruModel();
        $guru->update($id_guru,[
            'nip'=>$this->request->getPost('nip'),
            'nama'=>$this->request->getPost('nama'),
            'tempat'=>$this->request->getPost('tempat'),
            't_lahir'=>$this->request->getPost('t_lahir'),
            'j_kelamin'=>$this->request->getPost('j_kelamin'),
            'agama'=>$this->request->getPost('agama'),
            'no_hp'=>$this->request->getPost('no_hp'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('guru');
    }

    public function delete($id){
        $user = new GuruModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('guru');
    }

}
