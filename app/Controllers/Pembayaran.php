<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenSiswaModel;
use App\Models\EkstrakurikulerSiswaModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\NilaiModel;
use App\Models\NilaiUjianModel;
use App\Models\PembayaranModel;
use App\Models\PortofolioProyekModel;
use App\Models\SiswaModel;
use App\Models\SiswaPerkelasModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pembayaran extends BaseController
{
    protected $tahunajaran;
    protected $idTahunAjaran;
    public function __construct()
    {
        $model = new TahunAjaranModel();
        $tahunAjaran = $model->where('aktif', 1)->first();
        $this->tahunajaran = $tahunAjaran['tahun'];
        $this->idTahunAjaran = $tahunAjaran['id'];
    }
    public function index()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Pembayaran";
            $hover = "Pembayaran";
            $page = 'pembayaran';
            $model = new PembayaranModel();
            $row = $model->getDataPersemesterSiswa($this->idTahunAjaran);
            $column = ['tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
            $ceklist = 'hadir';
            $hiddenEdit = true;
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $data = "Pembayaran";
            $hover = "Pembayaran";
            $model = new PembayaranModel();
            $page = 'pembayaran';
            $column = ['nis', 'nama', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
            $ceklist = 'hadir';
            $row = $model->getDataPersemester($this->idTahunAjaran);
            $hiddenEdit = true;
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Pembayaran";
        $hover = "Pembayaran";
        $page = "pembayaran";
        $model = new PembayaranModel();
        $jenis_kelamin = $model->getEnumJenis('jenis');
        $enum = [
            'jenis' => $jenis_kelamin,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'jenis'],
            ['type' => 'number', 'name' => 'pembayaran_ke'],
            ['type' => 'rupiah', 'name' => 'jumlah'],
        ];
        $columnSiswa = ['nis', 'nama', 'jenis_kelamin'];
        $modelSiswa = new SiswaModel();
        $rowSiswa = $modelSiswa->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $columnSiswa,
                'rows' => $rowSiswa,
                'fieldName' => 'id_siswa',
                'select' => ['nis', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PembayaranModel();
        $data->insert([
            'id_tahun_ajaran' => $this->idTahunAjaran,
            'id_siswa' =>  $this->request->getPost('id_siswa'),
            'tanggal' =>  $this->request->getPost('tanggal'),
            'jenis' =>  $this->request->getPost('jenis'),
            'jumlah' =>  $this->request->getPost('jumlah'),
            'pembayaran_ke' =>  $this->request->getPost('pembayaran_ke'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect()->to('pembayaran');
    }
    public function edit($id)
    {
        $data = "Edit pembayaran";
        $hover = "pembayaran";
        $page = 'pembayaran';
        $model = new PembayaranModel();
        $jenis_kelamin = $model->getEnumJenis('jenis');
        $enum = [
            'jenis' => $jenis_kelamin,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_siswa'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'jenis'],
            ['type' => 'number', 'name' => 'pembayaran_ke'],
            ['type' => 'rupiah', 'name' => 'jumlah'],
        ];
        $columnSiswa = ['nis', 'nama', 'jenis_kelamin'];
        $modelSiswa = new SiswaModel();
        $rowSiswa = $modelSiswa->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $columnSiswa,
                'rows' => $rowSiswa,
                'fieldName' => 'id_siswa',
                'select' => ['nis', 'nama']
            ],
        ];
        $dt = $model->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->select('siswa.nama,siswa.nis,pembayaran.*')
            ->where('pembayaran.id', $id)->first();

        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PembayaranModel();
        $data->update($id, [
            'tanggal' =>  $this->request->getPost('tanggal'),
            'jenis' =>  $this->request->getPost('jenis'),
            'jumlah' =>  $this->request->getPost('jumlah'),
            'pembayaran_ke' =>  $this->request->getPost('pembayaran_ke'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pembayaran');
    }


    public function delete($id)
    {
        $data = new PembayaranModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('pembayaran');
    }

    public function report()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Pembayaran Siswa";
            $hover = "Pembayaran Siswa";
            $page = 'pembayaran';
            $model = new PembayaranModel();
            $row = $model->getDataPersemesterSiswa($this->idTahunAjaran);
            $cetak_satuan = true;
            $column = ['tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];

            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetak_satuan'));
        } else {
            $data = "Pembayaran Siswa";
            $hover = "Pembayaran Siswa";
            $page = 'pembayaran';
            $model = new PembayaranModel();
            $row = $model->getDataPersemester($this->idTahunAjaran);
            $cetak_satuan = true;
            $column = ['nis', 'nama', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetak_satuan'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Pembayaran Siswa";
        if (session()->get('level') == "Siswa") {
            if ($dari && $sampai) {
                $column = ['tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
                $model = new PembayaranModel();
                $row = $model->cetakDataBeetwenSiswa($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PembayaranModel();
                $row = $model->cetakDataPerSiswa();
                $column = ['tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nis', 'nama', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
                $model = new PembayaranModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PembayaranModel();
                $row = $model->cetakData();
                $column = ['nis', 'nama', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }

    public function cetakSatuan($id)
    {
        $data = "Kuitansi Pembayaran";
        $column = ['nis', 'nama', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah', 'semester', 'tahun'];
        $model = new PembayaranModel();
        $row = $model->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')
            ->where([
                'pembayaran.id' => $id,
            ])->first();

        return view('laporan/kuitansi', compact('column', 'row', 'data'));
    }
}
