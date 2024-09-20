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
        if (session()->get('role') == "Petugas Parkir" || session()->get('role') == "Masyarakat") {
            $data = "Retribusi Parkir";
            $hover = "Retribusi Parkir";
            $model = new RetribusiParkirModel();
            $page = 'retribusi_parkir';
            $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
            $row = $model->getData();
            $foto = true;
            $statusVerif = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'statusVerif'));
        } else {
            $data = "Retribusi Parkir";
            $hover = "Retribusi Parkir";
            $model = new RetribusiParkirModel();
            $page = 'retribusi_parkir';
            $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
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
        $page = "retribusi_parkir";
        $cari = $this->request->getPost('cari');
        $pengaduan = new RetribusiParkirModel();
        $row = $pengaduan->getData();
        $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
        $cetakData = true;
        return view('main/laporan', compact('data', 'hover', 'row', 'cari', 'page', 'column', 'cetakData'));
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Pengaduan";
        if (session()->get('role') == "Petugas Parkir") {
            if ($dari && $sampai) {
                $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
                $model = new RetribusiParkirModel();
                $row = $model->cetakDataBeetwenPengguna($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new RetribusiParkirModel();
                $row = $model->cetakDataPerPengguna();
                $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
                $model = new RetribusiParkirModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                $total = $model->getTotalJumlahBetween($dari, $sampai);
                $totalSum = true;
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data', 'totalSum', 'total'));
            } else {
                $model = new RetribusiParkirModel();
                $row = $model->cetakData();
                $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'foto', 'status'];
                $totalSum = true;
                $total = $model->getTotalJumlah();
                return view('laporan/cetak', compact('column', 'row', 'data', 'totalSum', 'total'));
            }
        }
    }
    public function cetakSatuan($id)
    {
        $column = ['nik', 'nama', 'nama_tempat', 'alamat', 'jumlah', 'tanggal_retribusi', 'status'];
        $model = new RetribusiParkirModel();
        $row = $model->join('tempat_parkir', 'tempat_parkir.id=retribusi_parkir.id_tempat_parkir')
            ->join('pegawai', 'pegawai.id=retribusi_parkir.id_petugas')
            ->select('retribusi_parkir.*,retribusi_parkir.tanggal_retribusi as tanggal,pegawai.nama,pegawai.nik,tempat_parkir.nama_tempat,tempat_parkir.alamat,tempat_parkir.status_operasional,retribusi_parkir.bukti as foto')
            ->where([
                'retribusi_parkir.id' => $id,
            ])->first();
        $modelPegawai = new PegawaiModel();
        $data = "Izin Parkir";
        $ttd = $modelPegawai->join('users', 'pegawai.user_id = users.id') // Bergabung dengan tabel 'users'
            ->where([
                'users.role' => 'Pimpinan',
            ])
            ->select('pegawai.nama, pegawai.nik') // Memilih kolom dari tabel 'pegawai'
            ->first();
        return view('laporan/cetakSatuan', compact('column', 'row', 'ttd', 'data'));
    }
}
