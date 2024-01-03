<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Guru extends BaseController
{
    public function index()
    {
        $data = "Guru";
        $hover = "Guru";
        $guru = new GuruModel();
        $d_guru = $guru->getGUru();
        if(session()->get('level') == "Admin"){
            $d_guru = $guru->getGUru();
            return view('guru/list',compact('data','d_guru','hover'));
        }else{
            $d_guru = $guru->where([
                'id' => session()->get('id_guru')
            ])->first();
            return view('guru/profil',compact('data','d_guru','hover'));
        }
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
                    'wakel'=> $this->request->getPost('wakel'),
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
                'wakel'=> $this->request->getPost('wakel'),
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
                    'wakel'=> $this->request->getPost('wakel'),
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
                'wakel'=> $this->request->getPost('wakel'),
                'foto'=> $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        $user = new UserModel();
        $pas = $this->request->getPost('password');
        if(empty($pas)){
            $user->update($id_user,[
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'level' => $this->request->getPost('level'),
            ]);
        }else{
            $user->update($id_user,[
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getPost('level'),
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

}
