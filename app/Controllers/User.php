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
        $model = new UserModel();
        $page = 'user';
        $column = ['name', 'username', 'email', 'level'];
        $row = $model->getData();
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah User";
        $hover = "Pengguna";
        $page = "user";
        $model = new UserModel();
        $enumValues = $model->getEnumValues('level');
        $enum = [
            'level' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'name'],
            ['type' => 'text', 'name' => 'username'],
            ['type' => 'email', 'name' => 'email'],
            ['type' => 'password', 'name' => 'password'],
            ['type' => 'enum', 'name' => 'level'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'enumValues'));
    }

    public function store()
    {
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

    public function edit($id)
    {
        $data = "Edit User";
        $hover = "Pengguna";
        $model = new UserModel();
        $page = "user";
        $model = new UserModel();
        $enumValues = $model->getEnumValues('level');
        $enum = [
            'level' => $enumValues
        ];
        $form = [
            ['type' => 'text', 'name' => 'name'],
            ['type' => 'text', 'name' => 'username'],
            ['type' => 'email', 'name' => 'email'],
            ['type' => 'password', 'name' => 'password'],
            ['type' => 'enum', 'name' => 'level'],
        ];
        $dt = $model->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'enumValues'));
    }

    public function update($id)
    {
        $user = new UserModel();
        $pas = $this->request->getPost('password');
        if (empty($pas)) {
            $user->update($id, [
                'name' => $this->request->getPost('name'),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'level' => $this->request->getPost('level'),
            ]);
        } else {
            $user->update($id, [
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

    public function delete($id)
    {
        $user = new UserModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('user');
    }
}
