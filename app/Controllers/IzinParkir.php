<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IzinParkirModel;
use App\Models\PegawaiModel;
use App\Models\TempatParkirModel;
use CodeIgniter\HTTP\ResponseInterface;

class IzinParkir extends BaseController
{
    public function index()
    {
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Masyarakat") {
            $data = "Izin Parkir";
            $hover = "Izin Parkir";
            $model = new IzinParkirModel();
            $page = 'izin_parkir';
            $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jenis', 'tanggal_mulai', 'tanggal_selesai', 'status'];
            $row = $model->getData();
            $foto = true;
            $statusVerif = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'statusVerif'));
        } else {
            $data = "Izin Parkir";
            $hover = "Izin Parkir";
            $model = new IzinParkirModel();
            $page = 'izin_parkir';
            $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jenis', 'tanggal_mulai', 'tanggal_selesai', 'status'];
            $row = $model->getData();
            $foto = true;
            $statusVerif = true;
            $verifikasi = true;
            $hiddenEdit = true;
            $hiddenDelete = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'statusVerif', 'verifikasi', 'hiddenEdit', 'hiddenDelete'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Izin Parkir";
        $hover = "Izin Parkir";
        $page = 'izin_parkir';
        $model = new IzinParkirModel();
        $enumValues = $model->getEnumValues('jenis');
        $enum = [
            'jenis' => $enumValues
        ];
        if (session()->get('role') == "Petugas Parkir") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_mulai'],
                ['type' => 'date', 'name' => 'tanggal_selesai'],
                ['type' => 'enum', 'name' => 'jenis'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_petugas'],
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'date', 'name' => 'tanggal_mulai'],
                ['type' => 'date', 'name' => 'tanggal_selesai'],
                ['type' => 'enum', 'name' => 'jenis'],
            ];
        }
        $column = ['nik', 'nama'];
        $model = new PegawaiModel();
        $rowRelasi = $model->getDataSelct();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_petugas',
                'select' => ['nik', 'nama']
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
        $izin_parkir = new IzinParkirModel();
        if (session()->get('role') == "Petugas Parkir") {
            $izin_parkir->insert([
                'id_petugas' => session()->get('id_pegawai'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'jenis' => $this->request->getPost('jenis'),
            ]);
        } else {
            $izin_parkir->insert([
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'jenis' => $this->request->getPost('jenis'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('izin_parkir');
    }

    public function edit($id)
    {
        $data = "Edit Izin Parkir";
        $hover = "Izin Parkir";
        $page = "izin_parkir";
        $model = new IzinParkirModel();
        $enumValues = $model->getEnumValues('jenis');
        $enum = [
            'jenis' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_petugas'],
            ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
            ['type' => 'date', 'name' => 'tanggal_mulai'],
            ['type' => 'date', 'name' => 'tanggal_selesai'],
            ['type' => 'enum', 'name' => 'jenis'],
        ];
        $column = ['nik', 'nama'];
        $modelPegawai = new PegawaiModel();
        $rowRelasi = $modelPegawai->getDataSelct();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_petugas',
                'select' => ['nik', 'nama']
            ],
            [
                'columns' => $columnTempatParkir,
                'rows' => $rowRelasiTempatParkir,
                'fieldName' => 'id_tempat_parkir',
                'select' => ['nama_tempat', 'alamat']
            ],
        ];
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=izin_parkir.id_tempat_parkir')
            ->join('pegawai', 'pegawai.id=izin_parkir.id_petugas')
            ->select('izin_parkir.*,pegawai.nik,pegawai.nama,pegawai.id as id_petugas,tempat_parkir.nama_tempat,tempat_parkir.alamat')->where([
                'izin_parkir.id' => $id,
            ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'relasi', 'enum'));
    }
    public function update($id)
    {
        $retribusi = new IzinParkirModel();
        $retribusi->update($id, [
            'id_petugas' => $this->request->getPost('id_petugas'),
            'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
            'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getPost('tanggal_selesai'),
            'jenis' => $this->request->getPost('jenis'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('izin_parkir');
    }

    public function verifikasi($id)
    {
        $data = "Verifikasi Izin Parkir";
        $hover = "Verifikasi Izin Parkir";
        $page = "izin_parkir";
        $model = new IzinParkirModel();
        $enumValues = $model->getEnumValues('status_izin');
        $enum = [
            'status_izin' => $enumValues
        ];
        $formAwal = [
            ['type' => 'relasi', 'name' => 'id_petugas'],
            ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
            ['type' => 'date', 'name' => 'tanggal_mulai'],
            ['type' => 'date', 'name' => 'tanggal_selesai'],
            ['type' => 'text', 'name' => 'jenis'],
        ];
        $formVerf = [
            ['type' => 'enum', 'name' => 'status_izin'],

        ];
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=izin_parkir.id_tempat_parkir')
            ->join('pegawai', 'pegawai.id=izin_parkir.id_petugas')
            ->select('izin_parkir.*,pegawai.nik,pegawai.nama,pegawai.id as id_petugas,tempat_parkir.nama_tempat,tempat_parkir.alamat')->where([
                'izin_parkir.id' => $id,
            ])->first();
        $column = ['nik', 'nama'];
        $modelPegawai = new PegawaiModel();
        $rowRelasi = $modelPegawai->getDataSelct();
        $columnTempatParkir = ['nama_tempat', 'alamat'];
        $modelTempatParkir = new TempatParkirModel();
        $rowRelasiTempatParkir = $modelTempatParkir->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_petugas',
                'select' => ['nik', 'nama']
            ],
            [
                'columns' => $columnTempatParkir,
                'rows' => $rowRelasiTempatParkir,
                'fieldName' => 'id_tempat_parkir',
                'select' => ['nama_tempat', 'alamat']
            ],
        ];
        $modeVerf = new IzinParkirModel();
        $dtVerf = $modeVerf->where('id', $id)->first();
        return view('main/Verifikasi', compact('data', 'hover', 'dt', 'page', 'formAwal', 'enum', 'relasi', 'formVerf', 'dtVerf'));
    }

    public function verifikasiStore($id)
    {
        $retribusi = new IzinParkirModel();
        $retribusi->update($id, [
            'status_izin' => $this->request->getPost('status_izin'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('izin_parkir');
    }

    public function delete($id)
    {
        $izin_parkir = new IzinParkirModel();
        $izin_parkir->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('izin_parkir');
    }

    public function laporan()
    {
        $data = "Laporan Izin Parkir";
        $hover = "Laporan Izin Parkir";
        $cari = $this->request->getPost('cari');
        $izin_parkir = new IzinParkirModel();
        $d_izin_parkir = $izin_parkir->getBarang();
        return view('izin_parkir/laporan', compact('data', 'hover', 'd_izin_parkir', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('izin_parkir/cetak', compact('cari'));
    }
}
