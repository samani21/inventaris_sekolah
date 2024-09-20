<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\RetribusiParkirModel;
use App\Models\TempatParkirModel;
use CodeIgniter\HTTP\ResponseInterface;

class RetribusiParkir extends BaseController
{
    public function index()
    {
        $data = "Retribusi Parkir";
        $hover = "Retribusi Parkir";
        $model = new RetribusiParkirModel();
        $page = 'retribusi_parkir';
        $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
        $row = $model->getData();
        $foto = true;
        $statusVerif = true;
        $verifikasi = true;
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'statusVerif', 'verifikasi'));
    }

    public function tambah()
    {
        $data = "Tambah Retribusi Parkir";
        $hover = "Retribusi Parkir";
        $page = 'retribusi_parkir';
        $enum = [];
        if (session()->get('role') == "Petugas Parkir") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'rupiah', 'name' => 'jumlah_pembayaran'],
                ['type' => 'date', 'name' => 'tanggal_retribusi'],
                ['type' => 'file', 'name' => 'bukti'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_petugas'],
                ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
                ['type' => 'rupiah', 'name' => 'jumlah_pembayaran'],
                ['type' => 'date', 'name' => 'tanggal_retribusi'],
                ['type' => 'file', 'name' => 'bukti'],
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
        $dataBerkas = $this->request->getFile('bukti');
        $fileName = $dataBerkas->getRandomName();
        $retribusi_parkir = new RetribusiParkirModel();
        if (session()->get('role') == "Petugas Parkir") {
            $retribusi_parkir->insert([
                'id_petugas' => session()->get('id_pegawai'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
                'bukti' => $fileName
            ]);
        } else {
            $retribusi_parkir->insert([
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
                'bukti' => $fileName
            ]);
        }

        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('retribusi_parkir');
    }

    public function edit($id)
    {
        $data = "Edit Retribusi Parkir";
        $hover = "Retribusi Parkir";
        $page = "retribusi_parkir";
        $model = new RetribusiParkirModel();
        $form = [
            ['type' => 'relasi', 'name' => 'id_petugas'],
            ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
            ['type' => 'rupiah', 'name' => 'jumlah_pembayaran'],
            ['type' => 'date', 'name' => 'tanggal_retribusi'],
            ['type' => 'file', 'name' => 'bukti'],
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
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=retribusi_parkir.id_tempat_parkir')
            ->join('pegawai', 'pegawai.id=retribusi_parkir.id_petugas')
            ->select('retribusi_parkir.*,pegawai.nik,pegawai.nama,pegawai.id as id_petugas,tempat_parkir.nama_tempat,tempat_parkir.alamat,retribusi_parkir.jumlah as jumlah_pembayaran')->where([
                'retribusi_parkir.id' => $id,
            ])->first();
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'relasi'));
    }
    public function update($id)
    {
        $retribusi = new RetribusiParkirModel();
        $dataBerkas = $this->request->getFile('bukti');
        if ($dataBerkas == "") {
            $retribusi->update($id, [
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $retribusi->update($id, [
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
                'bukti' => $fileName
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('retribusi_parkir');
    }

    public function verifikasi($id)
    {
        $data = "Verifikasi Retribusi Parkir";
        $hover = "Verifikasi Retribusi Parkir";
        $page = "retribusi_parkir";
        $model = new RetribusiParkirModel();
        $enumValues = $model->getEnumValues('status');
        $enum = [
            'status' => $enumValues
        ];
        $formAwal = [
            ['type' => 'relasi', 'name' => 'id_petugas'],
            ['type' => 'relasi', 'name' => 'id_tempat_parkir'],
            ['type' => 'rupiah', 'name' => 'jumlah_pembayaran'],
            ['type' => 'date', 'name' => 'tanggal_retribusi'],
        ];
        $formVerf = [
            ['type' => 'enum', 'name' => 'status'],

        ];
        $dt = $model->join('tempat_parkir', 'tempat_parkir.id=retribusi_parkir.id_tempat_parkir')
            ->join('pegawai', 'pegawai.id=retribusi_parkir.id_petugas')
            ->select('retribusi_parkir.*,pegawai.nik,pegawai.nama,pegawai.id as id_petugas,tempat_parkir.nama_tempat,tempat_parkir.alamat,retribusi_parkir.jumlah as jumlah_pembayaran')->where([
                'retribusi_parkir.id' => $id,
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
        $modeVerf = new TempatParkirModel();
        $dtVerf = $modeVerf->where('id', $id)->first();
        return view('main/Verifikasi', compact('data', 'hover', 'dt', 'page', 'formAwal', 'enum', 'relasi', 'formVerf', 'dtVerf'));
    }

    public function verifikasiStore($id)
    {
        $retribusi = new RetribusiParkirModel();
        $retribusi->update($id, [
            'status' => $this->request->getPost('status'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('retribusi_parkir');
    }

    public function delete($id)
    {
        $retribusi_parkir = new RetribusiParkirModel();
        $retribusi_parkir->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('retribusi_parkir');
    }

    public function laporan()
    {
        $data = "Laporan Retribusi Parkir";
        $hover = "Laporan Retribusi Parkir";
        $cari = $this->request->getPost('cari');
        $retribusi_parkir = new RetribusiParkirModel();
        $d_retribusi_parkir = $retribusi_parkir->getBarang();
        return view('retribusi_parkir/laporan', compact('data', 'hover', 'd_retribusi_parkir', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('retribusi_parkir/cetak', compact('cari'));
    }
}
