<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Siswa extends BaseController
{
    public function index()
    {
        $data = "Siswa";
        $hover = "Siswa";
        $model = new SiswaModel();
        $page = 'siswa';
        $column = ['nis', 'nama', 'ttl', 'agama', 'jenis_kelamin', 'no_hp', 'foto'];
        $row = $model->getData();
        // $hiddenButtonAdd = true;
        $foto = true;
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto'));
    }

    public function tambah()
    {
        $data = "Tambah Data Siswa";
        $hover = "Siswa";
        $page = "siswa";
        $model = new SiswaModel();
        $jenis_kelamin = $model->getEnumJenisKelamin('jenis_kelamin');
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nis'],
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
        $guru = new SiswaModel();
        $guru->insert([
            'user_id' => 18,
            'nis' => $this->request->getPost('nis'),
            'nama' => $this->request->getPost('nama'),
            'tempat' => $this->request->getPost('tempat'),
            'tanggal' => $this->request->getPost('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'agama' => $this->request->getPost('agama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'foto' => $fileName,
        ]);
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('siswa');
    }

    public function edit($id)
    {
        $data = "Edit Siswa";
        $hover = "Siswa";
        $page = "siswa";
        $model = new SiswaModel();
        $jenis_kelamin = $model->getEnumJenisKelamin('jenis_kelamin');
        $agama = $model->getEnumAgama('agama');
        $enum = [
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama
        ];
        $form = [
            ['type' => 'text', 'name' => 'nis'],
            ['type' => 'text', 'name' => 'nama'],
            ['type' => 'text', 'name' => 'tempat'],
            ['type' => 'date', 'name' => 'tanggal_lahir'],
            ['type' => 'enum', 'name' => 'agama'],
            ['type' => 'enum', 'name' => 'jenis_kelamin'],
            ['type' => 'text', 'name' => 'no_hp'],
            ['type' => 'file', 'name' => 'foto'],
        ];
        $dt = $model->select('nis,nama,tempat,tanggal as tanggal_lahir,agama,jenis_kelamin,no_hp,foto,id,foto')->where([
            'id' => $id,
        ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum'));
    }

    public function update($id_guru)
    {
        $guru = new SiswaModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_guru, [
                'nis' => $this->request->getPost('nis'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('no_hp'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_guru, [
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('no_hp'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('siswa');
    }

    public function profil($id_siswa, $id_user)
    {
        $guru = new SiswaModel();
        $foto = $this->request->getPost('foto');
        $dataBerkas = $this->request->getFile('foto');
        if ($dataBerkas == "") {
            $guru->update($id_siswa, [
                'nis' => $this->request->getPost('nis'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('hp'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $guru->update($id_siswa, [
                'nis' => $this->request->getPost('nis'),
                'nama' => $this->request->getPost('nama'),
                'tempat' => $this->request->getPost('tempat'),
                'tanggal' => $this->request->getPost('tanggal'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'agama' => $this->request->getPost('agama'),
                'no_hp' => $this->request->getPost('hp'),
                'foto' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('siswa');
    }

    public function delete($id)
    {
        $user = new SiswaModel();
        $user->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('siswa');
    }

    public function laporan()
    {
        $data = "Laporan Siswa";
        $hover = "Laporan Siswa";
        $barang = new SiswaModel();
        $d_guru = $barang->getGUru();
        return view('siswa/laporan', compact('data', 'hover', 'd_guru'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('siswa/cetak', compact('cari'));
    }
}
