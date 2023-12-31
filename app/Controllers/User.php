<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function index()
    {
        $data = "Pengguna";
        $hover = "Pengguna";
        $user = new UserModel();
        $d_user = $user->getUser();
        return view('user/list',compact('data','d_user','hover'));
    }

    public function tambah()
    {
        $data = "Tambah User";
        $hover = "Pengguna";
        return view('user/tambah',compact('data','hover'));
    }

    public function store(){
        $user = new UserModel();
        $user->insert([
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level'),
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('user');
    }

    public function edit($id){
        $data = "Edit User";
        $hover = "Pengguna";
        $user = new UserModel();
        $dt = $user->where([
            'id'=>$id,
        ])->first();
        return view('user/edit',compact('data','hover','dt'));
    }

    public function update($id){
        $user = new UserModel();
        $pas = $this->request->getPost('password');
        if(empty($pas)){
            $user->update($id,[
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'level' => $this->request->getPost('level'),
            ]);
        }else{
            $user->update($id,[
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getPost('level'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('user');
    }

    public function delete($id){
        $user = new UserModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('user');
    }
}
