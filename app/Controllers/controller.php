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
        $data = "1";
        $hover = "1";
        $model = new RetribusiParkirModel();
        $page = '2';
        $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
        $row = $model->getData();
        $foto = true;
        $statusVerif = true;
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'statusVerif'));
    }

    public function tambah()
    {
        $data = "Tambah 1";
        $hover = "1";
        $page = '2';
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
        $2 = new RetribusiParkirModel();
        if (session()->get('role') == "Petugas Parkir") {
            $2->insert([
                'id_petugas' => session()->get('id_pegawai'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
                'bukti' => $fileName
            ]);
        } else {
            $2->insert([
                'id_petugas' => $this->request->getPost('id_petugas'),
                'id_tempat_parkir' => $this->request->getPost('id_tempat_parkir'),
                'jumlah' => $this->request->getPost('jumlah_pembayaran'),
                'tanggal_retribusi' => $this->request->getPost('tanggal_retribusi'),
                'bukti' => $fileName
            ]);
        }

        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('2');
    }

    public function edit($id)
    {
        $data = "Edit 1";
        $hover = "1";
        $page = "2";
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

    public function delete($id)
    {
        $2 = new RetribusiParkirModel();
        $2->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('2');
    }

    public function laporan()
    {
        $data = "Laporan 1";
        $hover = "Laporan 1";
        $cari = $this->request->getPost('cari');
        $2 = new RetribusiParkirModel();
        $d_2 = $2->getBarang();
        return view('retribusi_parkir/laporan', compact('data', 'hover', 'd_retribusi_parkir', 'cari'));
    }

    public function cetak()
    {
        $cari = $this->request->getPost('cari');
        return view('2/cetak', compact('cari'));
    }
}
