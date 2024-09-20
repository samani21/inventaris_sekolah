<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\TempatParkirModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pengaduan extends BaseController
{
    public function index()
    {
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Masyarakat") {

            $data = "Pengaduan";
            $hover = "Pengaduan";
            $model = new PengaduanModel();
            $page = 'pengaduan';
            $column = ['name', 'email', 'nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
            $row = $model->getData();
            $statusVerif = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        } else {
            $data = "Pengaduan";
            $hover = "Pengaduan";
            $model = new PengaduanModel();
            $page = 'pengaduan';
            $column = ['name', 'email', 'nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
            $row = $model->getData();
            $statusVerif = true;
            $verifikasi = true;
            $hiddenEdit = true;
            $hiddenDelete = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif', 'verifikasi', 'hiddenEdit', 'hiddenDelete'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Pengaduan";
        $hover = "Pengaduan";
        $page = 'pengaduan';
        $enum = [];
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Pengguna") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_pengaduan'],
                ['type' => 'text', 'name' => 'jenis_pengaduan'],
                ['type' => 'textArea', 'name' => 'deskripsi_pengaduan'],

            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_pengguna'],
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_pengaduan'],
                ['type' => 'text', 'name' => 'jenis_pengaduan'],
                ['type' => 'textArea', 'name' => 'deskripsi_pengaduan'],

            ];
        }
        $column = ['name', 'email'];
        $model = new UserModel();
        $rowRelasi = $model->getData();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_pengguna',
                'select' => ['name', 'email']
            ],
            [
                'columns' => $columnTempatParkir,
                'rows' => $rowRelasiTempatParkir,
                'fieldName' => 'id_tempat_parkir',
                'select' => ['nama_tempat', 'alamat']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }
    public function store()
    {
        $pengaduan = new PengaduanModel();
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Pengguna") {
            $pengaduan->insert([
                'id_pengguna' => session()->get('id'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_pengaduan' => $this->request->getPost('tanggal_pengaduan'),
                'jenis_pengaduan' => $this->request->getPost('jenis_pengaduan'),
                'deskripsi_pengaduan' => $this->request->getPost('deskripsi_pengaduan'),
            ]);
        } else {
            $pengaduan->insert([
                'id_pengguna' => $this->request->getPost('id_pengguna'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_pengaduan' => $this->request->getPost('tanggal_pengaduan'),
                'jenis_pengaduan' => $this->request->getPost('jenis_pengaduan'),
                'deskripsi_pengaduan' => $this->request->getPost('deskripsi_pengaduan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('pengaduan');
    }

    public function edit($id)
    {
        $data = "Edit Pengaduan";
        $hover = "Pengaduan";
        $page = "pengaduan";
        $model = new PengaduanModel();
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Pengguna") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_pengaduan'],
                ['type' => 'text', 'name' => 'jenis_pengaduan'],
                ['type' => 'textArea', 'name' => 'deskripsi_pengaduan'],

            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_pengguna'],
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_pengaduan'],
                ['type' => 'text', 'name' => 'jenis_pengaduan'],
                ['type' => 'textArea', 'name' => 'deskripsi_pengaduan'],

            ];
        }
        $column = ['name', 'email'];
        $modelUsers = new UserModel();
        $rowRelasi = $modelUsers->getData();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_pengguna',
                'select' => ['name', 'email']
            ],
            [
                'columns' => $columnTempatParkir,
                'rows' => $rowRelasiTempatParkir,
                'fieldName' => 'id_tempat_parkir',
                'select' => ['nama_tempat', 'alamat']
            ],
        ];
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=pengaduan.id_tempat_parkir')
            ->join('users', 'users.id=Pengaduan.id_pengguna')
            ->select('pengaduan.*,users.name,users.email,tempat_parkir.nama_tempat,tempat_parkir.alamat')->where([
                'pengaduan.id' => $id,
            ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'relasi'));
    }
    public function update($id)
    {
        $pengaduan = new PengaduanModel();

        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Pengguna") {
            $pengaduan->update($id, [
                'id_pengguna' => session()->get('id'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_pengaduan' => $this->request->getPost('tanggal_pengaduan'),
                'jenis_pengaduan' => $this->request->getPost('jenis_pengaduan'),
                'deskripsi_pengaduan' => $this->request->getPost('deskripsi_pengaduan'),
            ]);
        } else {
            $pengaduan->update($id, [
                'id_pengguna' => $this->request->getPost('id_pengguna'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_pengaduan' => $this->request->getPost('tanggal_pengaduan'),
                'jenis_pengaduan' => $this->request->getPost('jenis_pengaduan'),
                'deskripsi_pengaduan' => $this->request->getPost('deskripsi_pengaduan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pengaduan');
    }
    public function verifikasi($id)
    {
        $data = "Verifikasi Pengaduan";
        $hover = "Verifikasi Pengaduan";
        $page = "pengaduan";
        $model = new PengaduanModel();
        $enumValues = $model->getEnumValues('status_pengaduan');
        $enum = [
            'status_pengaduan' => $enumValues
        ];
        $formAwal = [
            ['type' => 'relasi', 'name' => 'id_pengguna'],
            ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
            ['type' => 'date', 'name' => 'tanggal_pengaduan'],
            ['type' => 'text', 'name' => 'jenis_pengaduan'],
            ['type' => 'textArea', 'name' => 'deskripsi_pengaduan'],

        ];
        $formVerf = [
            ['type' => 'enum', 'name' => 'status_pengaduan'],

        ];
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=pengaduan.id_tempat_parkir')
            ->join('users', 'users.id=Pengaduan.id_pengguna')
            ->select('pengaduan.*,users.name,users.email,tempat_parkir.nama_tempat,tempat_parkir.alamat')->where([
                'pengaduan.id' => $id,
            ])->first();
        $column = ['name', 'email'];
        $modelUsers = new UserModel();
        $rowRelasi = $modelUsers->getData();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_pengguna',
                'select' => ['name', 'email']
            ],
            [
                'columns' => $columnTempatParkir,
                'rows' => $rowRelasiTempatParkir,
                'fieldName' => 'id_tempat_parkir',
                'select' => ['nama_tempat', 'alamat']
            ],
        ];
        $modeVerf = new PengaduanModel();
        $dtVerf = $modeVerf->where('id', $id)->first();
        return view('main/Verifikasi', compact('data', 'hover', 'dt', 'page', 'formAwal', 'enum', 'relasi', 'formVerf', 'dtVerf'));
    }

    public function verifikasiStore($id)
    {
        $retribusi = new PengaduanModel();
        $retribusi->update($id, [
            'status_pengaduan' => $this->request->getPost('status_pengaduan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pengaduan');
    }

    public function delete($id)
    {
        $pengaduan = new PengaduanModel();
        $pengaduan->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('pengaduan');
    }

    public function laporan()
    {
        $data = "Laporan Pengaduan";
        $hover = "Laporan Pengaduan";
        $page = "pengaduan";
        $cari = $this->request->getPost('cari');
        $pengaduan = new PengaduanModel();
        $row = $pengaduan->getData();
        $column = ['name', 'email', 'nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];

        return view('main/laporan', compact('data', 'hover', 'row', 'cari', 'page', 'column'));
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Pengaduan";
        if (session()->get('role') == "Petugas Parkir") {
            if ($dari && $sampai) {
                $column = ['name', 'email', 'nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
                $model = new PengaduanModel();
                $row = $model->cetakDataBeetwenPengguna($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PengaduanModel();
                $row = $model->cetakDataPerPengguna();
                $column = ['name', 'email', 'nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
                $model = new PengaduanModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PengaduanModel();
                $row = $model->cetakData();
                $column = ['nama_tempat', 'alamat', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }
}
