<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class TataUsaha extends BaseController
{
    public function index()
    {
        $data = "Guru";
        $hover = "Guru";
        $guru = new GuruModel();
        $d_guru = $guru->getGUru();
        $d_guru = $guru->getGUru();
        return view('tata_usaha/list',compact('data','d_guru','hover'));
    }

    public function tambah(){
        $data = "Tambah Data Guru";
        $hover = "Guru";
        return view('tata_usaha/tambah',compact('data','hover'));
    }

    public function store(){
        $dataBerkas = $this->request->getFile('foto');
        $fileName = $dataBerkas->getRandomName();
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
            'foto'=> $fileName,
        ]);
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('/');
    }

    public function edit($id){
        $data = "Edit Guru";
        $hover = "Pengguna";
        $user = new GuruModel();
        $dt = $user->where([
            'id'=>$id,
        ])->first();
        return view('tata_usaha/edit',compact('data','hover','dt'));
    }

    public function update($id_guru){
        $guru = new GuruModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if($dataBerkas == ""){
            $guru->update($id_guru,[
                    'nip'=>$this->request->getPost('nip'),
                    'nama'=>$this->request->getPost('nama'),
                    'tempat'=>$this->request->getPost('tempat'),
                    't_lahir'=>$this->request->getPost('t_lahir'),
                    'j_kelamin'=>$this->request->getPost('j_kelamin'),
                    'agama'=>$this->request->getPost('agama'),
                    'no_hp'=> $this->request->getPost('hp'),
                ]);
        }else{
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru,[
                'nip'=>$this->request->getPost('nip'),
                'nama'=>$this->request->getPost('nama'),
                'tempat'=>$this->request->getPost('tempat'),
                't_lahir'=>$this->request->getPost('t_lahir'),
                'j_kelamin'=>$this->request->getPost('j_kelamin'),
                'agama'=>$this->request->getPost('agama'),
                'no_hp'=> $this->request->getPost('hp'),
                'foto'=> $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('guru');
    }

    public function profil($id_guru,$id_user){
        $guru = new GuruModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if($dataBerkas == ""){
            $guru->update($id_guru,[
                    'nip'=>$this->request->getPost('nip'),
                    'nama'=>$this->request->getPost('nama'),
                    'tempat'=>$this->request->getPost('tempat'),
                    't_lahir'=>$this->request->getPost('t_lahir'),
                    'j_kelamin'=>$this->request->getPost('j_kelamin'),
                    'agama'=>$this->request->getPost('agama'),
                    'no_hp'=> $this->request->getPost('hp'),
                ]);
        }else{
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru,[
                'nip'=>$this->request->getPost('nip'),
                'nama'=>$this->request->getPost('nama'),
                'tempat'=>$this->request->getPost('tempat'),
                't_lahir'=>$this->request->getPost('t_lahir'),
                'j_kelamin'=>$this->request->getPost('j_kelamin'),
                'agama'=>$this->request->getPost('agama'),
                'no_hp'=> $this->request->getPost('hp'),
                'foto'=> $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        $user = new UserModel();
        $pas = $this->request->getPost('password');
        if(empty($pas)){
            $user->update($id_user,[
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ]);
        }else{
            $user->update($id_user,[
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('guru');
    }

    public function delete($id){
        $user = new GuruModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('guru');
    }

    public function laporan(){
        $data = "Laporan Guru";
        $hover = "Laporan Guru";
        $barang = new GuruModel();
        $d_guru = $barang->getGUru();
        return view('tata_usaha/laporan',compact('data','hover','d_guru'));
    }

    public function cetak(){
        $cari = $this->request->getPost('cari');
        return view('tata_usaha/cetak',compact('cari'));
    }
}
