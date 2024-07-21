<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRuanganModel;
use App\Models\BaranmasukModel;
use App\Models\GuruModel;
use App\Models\RuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class BarangPakai extends BaseController
{
    public function index($ruangan)
    {
        @$dari = $_GET['dari'];
        @$sampai = $_GET['sampai'];
        $data = "Barang di " . $ruangan;
        $hover = "Barang di " . $ruangan;
        $page = 'barang_ruangan/' . $ruangan;
        $model = new BarangRuanganModel();
        if (empty($dari)) {
            $row = $model->getData();
        } else {
            $row = $model->getDataBeetwen($dari, $sampai);
        }
        $between = true;
        $verifikasi = true;
        $status = 'status_pinjam';
        $hiddenEdit = true;
        $column = ['kode_barang', 'nama_barang', 'status', 'tanggal_pinjam', 'stok', 'ruangan', 'tanggal_selesai', 'stok_selesai', 'status_pinjam'];
        return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'between', 'status', 'verifikasi', 'hiddenEdit'));
    }

    public function tambah($ruangan)
    {
        $data = "Tambah Barang Ruangan " . $ruangan;
        $hover = "Barang Ruangan " . $ruangan;
        $page = "barang_ruangan/" . $ruangan;
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'relasi', 'name' => 'id_barang_masuk'],
            ['type' => 'number', 'name' => 'total'],
            ['type' => 'date', 'name' => 'tanggal_pinjam'],
        ];
        $columnGuru = ['nip', 'nama', 'jenis_kelamin'];
        $modelGuru = new GuruModel();
        $rowGuru = $modelGuru->getData();
        $columnBarangMasuk = ['kode_barang', 'nama_barang', 'total', 'status'];
        $modelBarangMasuk = new BaranmasukModel();
        $rowBarangMasuk = $modelBarangMasuk->getbarang1();
        $relasi = true;
        $relasi = [
            [
                'columns' => $columnGuru,
                'rows' => $rowGuru,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnBarangMasuk,
                'rows' => $rowBarangMasuk,
                'fieldName' => 'id_barang_masuk',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store($ruangan)
    {
        $ruangan = ucwords(str_replace('_', ' ', $ruangan));
        $data = new BarangRuanganModel();
        $data->insert([
            'id_guru' => $this->request->getPost('id_guru'),
            'id_barang_masuk' => $this->request->getPost('id_barang_masuk'),
            'tgl_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'stok' => $this->request->getPost('total'),
            'ruangan' => $ruangan,
            'status_r' => 1,
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect()->to('/barang_peruangan/' . $ruangan);
    }

    public function verifikasi($ruangan, $id)
    {
        $data = "Barang Selesai Ruangan " . $ruangan;
        $hover = "Barang Ruangan " . $ruangan;
        $page = "barang_ruangan/" . $ruangan;
        $model = new BarangRuanganModel();
        $enum = [];
        $formAwal = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'relasi', 'name' => 'id_barang_masuk'],
            ['type' => 'number', 'name' => 'total_pinjam'],
            ['type' => 'date', 'name' => 'tanggal_pinjam'],
        ];
        $formVerf = [
            ['type' => 'date', 'name' => 'tanggal_selesai'],
            ['type' => 'number', 'name' => 'total_selesai'],
        ];
        $dt = $model->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_peruangan.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->join('guru', 'guru.id=barang_peruangan.id_guru')
            ->where([
                'barang_peruangan.id' => $id,
            ])->select('
            guru.id as id_guru,
            barang_masuk.id_barang_masuk,
            barang.nama_barang,barang.kode_barang,
            barang_masuk.status,
            barang_peruangan.id,
            barang_peruangan.tgl_pinjam as tanggal_pinjam,
            barang_peruangan.tgl_selesai as tanggal_selesai,
            barang_peruangan.stok as total_pinjam,
            barang_peruangan.stok_selesai as total_selesai,
            barang_peruangan.ruangan,
            barang_peruangan.status_r as status_pinjam,
            guru.nama,guru.nip')
            ->first();
        $columnGuru = ['nip', 'nama', 'jenis_kelamin'];
        $modelGuru = new GuruModel();
        $rowGuru = $modelGuru->getData();
        $columnBarangMasuk = ['kode_barang', 'nama_barang', 'total', 'status'];
        $modelBarangMasuk = new BaranmasukModel();
        $rowBarangMasuk = $modelBarangMasuk->getbarang1();
        $relasi = true;
        $relasi = [
            [
                'columns' => $columnGuru,
                'rows' => $rowGuru,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnBarangMasuk,
                'rows' => $rowBarangMasuk,
                'fieldName' => 'id_barang_masuk',
                'select' => ['kode_barang', 'nama_barang']
            ],
        ];
        $dtVerf = $dt;
        return view('main/Verifikasi', compact('data', 'hover', 'dt', 'page', 'formAwal', 'enum', 'relasi', 'formVerf', 'dtVerf'));
    }

    public function verifikasiStore($ruangan, $id)
    {
        if ($this->request->getPost('total_selesai') < 0) {
            session()->setFlashdata("failed", "Gagal Verifikasi data cek total dimasukkan");
            return redirect()->to('/barang_peruangan/' . $ruangan);
        } else {
            $modelBarangRuangan = new BarangRuanganModel();
            $barangRuangan = $modelBarangRuangan->where([
                'id' => $id,
            ])->first();
            if ($this->request->getPost('total_selesai') > $barangRuangan['stok']) {
                session()->setFlashdata("failed", "Gagal update data cek total dimasukkan");
                return redirect()->to('/barang_peruangan/' . $ruangan);
            } else {
                $total = $this->request->getPost('total_selesai');
                if ($barangRuangan['stok_selesai'] == null) {
                    $toalAwal = $barangRuangan['stok_selesai'];
                    $modelBarangMasuk = new BaranmasukModel();
                    $modelBarangMasuk->barangSelesaiPakai($barangRuangan['id_barang_masuk'], $toalAwal, $total);
                } else {
                    $toalAwal = $barangRuangan['stok_selesai'];
                    $modelBarangMasuk = new BaranmasukModel();
                    $modelBarangMasuk->UpdatebarangSelesaiPakai($barangRuangan['id_barang_masuk'],  $toalAwal, $total);
                }
                if ($total === $barangRuangan['stok']) {
                    $modelBarangRuangan->update($id, [
                        'tgl_selesai' => $this->request->getPost('tanggal_selesai'),
                        'stok_selesai' => $total,
                        'status_r' => 2,
                    ]);
                } else {
                    $modelBarangRuangan->update($id, [
                        'tgl_selesai' => $this->request->getPost('tanggal_selesai'),
                        'stok_selesai' => $total,
                        'status_r' => 1,
                    ]);
                }
                session()->setFlashdata("success", "Berhasil update data");
                return redirect()->to('/barang_peruangan/' . $ruangan);
            }
        }
    }


    public function edit($id)
    {
        $data = "Edit Barang Pakai";
        $hover = "Barang Pakai";
        $barag_pakai = new BarangRuanganModel();
        $br = $barag_pakai->where([
            'id_barang_peruangan' => $id,
        ])->first();

        $barang = new BaranmasukModel();
        $d_barang = $barang->where([
            'id_barang_masuk' => $br['id_barang_masuk']
        ])->first();

        $barang = new BarangModel();
        $d_barang = $barang->where([
            'id' => $d_barang['id_barang']
        ])->first();
        $ruangan = new RuanganModel();
        $ruangan = $ruangan->getRuangan();
        return view('barang_ruangan/edit', compact('data', 'hover', 'd_barang', 'br', 'ruangan'));
    }

    public function update($id)
    {
        $ru = $this->request->getPost('ruangan');
        $data = new BarangRuanganModel();
        $data->update($id, [
            'tgl_pinjam' => $this->request->getPost('tgl_pinjam'),
            'stok' => $this->request->getPost('stok'),
            'ruangan' => $this->request->getPost('ruangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/' . $ru);
    }

    public function update1($id)
    {
        $ru = $this->request->getPost('ruangan');
        $data = new BarangRuanganModel();
        $data->update($id, [
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'stok_selesai' => $this->request->getPost('stok_selesai'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('barang_peruangan/' . $ru);
    }

    public function delete($id, $ru)
    {
        $data = new BarangRuanganModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect()->to('barang_peruangan/' . $ru);
    }

    public function laporan_pakai($ruangan)
    {
        $data = "Laporan Barang Ruangan " . $ruangan;
        $hover = "Laporan Barang Ruangan " . $ruangan;
        $data1 = new BarangRuanganModel();
        $dt = $data1->getPakai($ruangan);
        return view('barang_ruangan/laporan_pakai', compact('data', 'hover', 'dt', 'ruangan'));
    }

    public function cetak_pakai()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        $ruangan = $this->request->getPost('ruangan');
        return view('barang_ruangan/cetak_pakai', compact('dari', 'sampai', 'ruangan'));
    }
}
