<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\NilaiGuruModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiGuru extends BaseController
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
        if (session()->get('level') == "Guru") {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getDataPerguru();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $column = ['tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $verif = true;
            $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd', 'verif'));
        } else {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Nilai Guru";
        $hover = "Nilai Guru";
        $page = 'nilai_guru';
        $model = new NilaiGuruModel();
        $kategori = $model->getEnumKategori('kategori');
        $enum = [
            'kategori' => $kategori,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'kategori'],
            ['type' => 'number', 'name' => 'nilai'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $column = ['nip', 'nama', 'ttl', 'level'];
        $modelRelasi = new GuruModel();
        $rowRelasi = $modelRelasi->getDataSelct();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new NilaiGuruModel();
        $data->insert([
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nilai' => $this->request->getPost('nilai'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
            'id_tahun_ajaran' => $this->idTahunAjaran
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('nilai_guru');
    }


    public function edit($id)
    {
        $data = "Edit Nilai Guru";
        $hover = "Nilai Guru";
        $page = 'nilai_guru';
        $model = new NilaiGuruModel();
        $kategori = $model->getEnumKategori('kategori');
        $enum = [
            'kategori' => $kategori,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'kategori'],
            ['type' => 'number', 'name' => 'nilai'],
            ['type' => 'textArea', 'name' => 'keterangan'],
        ];
        $dt = $model->join('guru', 'guru.id=nilai_guru.id_guru')
            ->where([
                'nilai_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,nilai_guru.*')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new NilaiGuruModel();
        $data->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'nilai' => $this->request->getPost('nilai'),
            'kategori' => $this->request->getPost('kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('nilai_guru');
    }

    public function verifikasi($id)
    {
        $data = new NilaiGuruModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('nilai_guru');
    }


    public function delete($id)
    {
        $data = new NilaiGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('nilai_guru');
    }


    public function report()
    {
        if (session()->get('level') == "Guru") {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getDataPerguru();
            $column = ['tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];

            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $data = "Nilai Guru";
            $hover = "Nilai Guru";
            $page = 'nilai_guru';
            $model = new NilaiGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Nilai Guru";
        if (session()->get('level') == "Guru") {
            if ($dari && $sampai) {
                $column = ['tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
                $model = new NilaiGuruModel();
                $row = $model->cetakDataBeetwenGuru($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new NilaiGuruModel();
                $row = $model->cetakDataPerguru();
                $column = ['tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
                $model = new NilaiGuruModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new NilaiGuruModel();
                $row = $model->cetakData();
                $column = ['nip', 'nama', 'tanggal', 'nilai', 'kategori', 'keterangan', 'semester', 'tahun'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }
}
