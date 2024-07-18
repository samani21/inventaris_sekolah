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
        $data = "Tata Usaha";
        $hover = "Tata Usaha";
        $model = new GuruModel();
        $page = 'tata_usaha';
        $column = ['nip', 'nama', 'ttl', 'agama', 'jenis_kelamin', 'no_hp'];
        $row = $model->getData();
        // $hiddenButtonAdd = true;
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
    }

    public function tambah()
    {
        $data = "Tambah Data Tata Usaha";
        $hover = "Tata Usaha";
        $page = "tata_usaha";
        $model = new GuruModel();
        $jenis_kelamin = $model->getEnumJenisKelamin('j_kelamin');
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nip'],
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'date', 'name' => 'tanggal_lahir'],
            ['type' => 'enum', 'name' => 'agama'],
            ['type' => 'enum', 'name' => 'jenis_kelamin'],
            ['type' => 'text', 'name' => 'no_hp'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    }

    public function store()
    {
        $dataBerkas = $this->request->getFile('foto');
        $fileName = $dataBerkas->getRandomName();
        $guru = new GuruModel();
        $guru->insert([
            'user_id' => 18,
            'nip' => $this->request->getPost('nip'),
            'nama' => $this->request->getPost('nama'),
            'tempat' => $this->request->getPost('tempat'),
            't_lahir' => $this->request->getPost('tanggal_lahir'),
            'j_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'foto' => $fileName,
        ]);
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('/');
    }

    public function edit($id)
    {
        $data = "Edit Tata Usaha";
        $hover = "Tata Usaha";
        $page = "tata_usaha";
        $model = new GuruModel();
        $jenis_kelamin = $model->getEnumJenisKelamin('j_kelamin');
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nip'],
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'date', 'name' => 'tanggal_lahir'],
            ['type' => 'enum', 'name' => 'agama'],
            ['type' => 'enum', 'name' => 'jenis_kelamin'],
            ['type' => 'text', 'name' => 'no_hp'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        $dt = $model->select('nip,nama,tempat,t_lahir as tanggal_lahir,agama,j_kelamin as jenis_kelamin,no_hp,foto,id,foto')->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }

    public function update($id_guru)
    {
        $guru = new GuruModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_guru, [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                't_lahir' => $this->request->getPost('tanggal_lahir'),
                'j_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('no_hp'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru, [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                't_lahir' => $this->request->getPost('tanggal_lahir'),
                'j_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('no_hp'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('tata_usaha');
    }

    public function profil($id_guru, $id_user)
    {
        $guru = new GuruModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_guru, [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                't_lahir' => $this->request->getPost('t_lahir'),
                'j_kelamin' => $this->request->getPost('j_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('hp'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru, [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                't_lahir' => $this->request->getPost('t_lahir'),
                'j_kelamin' => $this->request->getPost('j_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('hp'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        $user = new UserModel();
        $pas = $this->request->getPost('password');
        if (empty($pas)) {
            $user->update($id_user, [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ]);
        } else {
            $user->update($id_user, [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('tata_usaha');
    }

    public function delete($id)
    {
        $user = new GuruModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('tata_usaha');
    }

    public function laporan()
    {
        $data = "Laporan Tata Usaha";
        $hover = "Laporan Tata Usaha";
        $barang = new GuruModel();
        $d_guru = $barang->getGUru();
        return view('tata_usaha/laporan', compact('data', 'hover', 'd_guru'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('tata_usaha/cetak', compact('cari'));
    }
}
