<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pegawai extends BaseController
{
    public function index()
    {
        $data = "Pegawai";
        $hover = "Pegawai";
        $model = new PegawaiModel();
        $page = 'pegawai';
        $hiddenButtonAdd = true;
        $column = ['nik', 'nama', 'ttl', 'agama', 'jenis_klamin', 'alamat', 'no_telepon', 'role', 'tanggal_bergabung', 'foto'];
        $row = $model->getData();
        // $hiddenButtonAdd = true;
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd'));
    }

    // public function tambah()
    // {
    //     $data = "Tambah Data Pegawai";
    //     $hover = "Pegawai";
    //     $page = "pegawai";
    //     $model = new PegawaiModel();
    //     $jenis_kelamin = $model->getEnumJenisKelamin('j_kelamin');
    //     $agama = $model->getEnumAgama('agama');
    //     $enum = [
    //         'jenis_kelamin' => $jenis_kelamin,
    //         'agama' => $agama
    //     ];
    //     $form = [
    //         ['type' => 'text', 'name' => 'nik'],
    //         ['type' => 'text', 'name' => 'nama'],
    //         ['type' => 'text', 'name' => 'tempat'],
    //         ['type' => 'date', 'name' => 'tanggal_lahir'],
    //         ['type' => 'enum', 'name' => 'agama'],
    //         ['type' => 'enum', 'name' => 'jenis_kelamin'],
    //         ['type' => 'text', 'name' => 'no_hp'],
    //         ['type' => 'file', 'name' => 'foto'],
    //     ];
    //     return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum'));
    // }

    public function store()
    {
        $dataBerkas = $this->request->getFile('foto');
        $fileName = $dataBerkas->getRandomName();
        $guru = new PegawaiModel();
        $guru->insert([
            'user_id' => $this->request->getPost('user_id'),
            'nik' => $this->request->getPost('nik'),
            'nama' => $this->request->getPost('nama'),
            'tempat' => $this->request->getPost('tempat'),
            'tanggal' => $this->request->getPost('t_lahir'),
            'jeni_kelamin' => $this->request->getPost('j_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_hp'),
            'tanggal_bergabung' => date('Y-m-d'),
            'foto' => $fileName,
        ]);
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('/');
    }

    public function edit($id)
    {
        $data = "Edit Pegawai";
        $hover = "Pegawai";
        $page = "pegawai";
        $model = new PegawaiModel();
        $jenis_kelamin = $model->getEnumJenisKelamin('jenis_klamin');
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'jenis_klamin' => $jenis_kelamin,
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nik'],
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'agama'],
            ['type' => 'enum', 'name' => 'jenis_klamin'],
            ['type' => 'text', 'name' => 'no_telepon'],
            ['type' => 'text', 'name' => 'alamat'],
            ['type' => 'date', 'name' => 'tanggal_bergabung'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        $dt = $model->select('nik,nama,tempat,tanggal,agama,jenis_klamin,no_telepon,foto,id,tanggal_bergabung,alamat')->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }

    public function update($id_guru)
    {
        $guru = new PegawaiModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_guru, [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jeni_kelamin' => $this->request->getPost('jenis_klamin'),
                'agama' => $this->request->getPost('agama'),
                'alamat' => $this->request->getPost('alamat'),
                'no_telepon' => $this->request->getPost('no_telepon'),
                'tanggal_bergabung' => $this->request->getPost('tanggal_bergabung'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru, [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jeni_kelamin' => $this->request->getPost('jenis_klamin'),
                'agama' => $this->request->getPost('agama'),
                'alamat' => $this->request->getPost('alamat'),
                'no_telepon' => $this->request->getPost('no_telepon'),
                'tanggal_bergabung' => $this->request->getPost('tanggal_bergabung'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pegawai');
    }

    public function profil($id_guru, $id_user)
    {
        $guru = new PegawaiModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_guru, [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jenis_klamin' => $this->request->getPost('jenis_klamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('hp'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru, [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jenis_klamin' => $this->request->getPost('jenis_klamin'),
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
                'name' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
            ]);
        } else {
            $user->update($id_user, [
                'name' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ]);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->back();
    }

    public function delete($id)
    {
        $user = new PegawaiModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('pegawai');
    }

    public function laporan()
    {
        $data = "Laporan Pegawai";
        $hover = "Laporan Pegawai";
        $barang = new PegawaiModel();
        $d_guru = $barang->getGUru();
        return view('pegawai/laporan', compact('data', 'hover', 'd_guru'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('pegawai/cetak', compact('cari'));
    }
}
