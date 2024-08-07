<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\JadwalKelasModel;
use App\Models\KelasModel;
use App\Models\MapelModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalKelas extends BaseController
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
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_siswa = session()->get('id');
            $row = $model->getDataPersiswa($id_siswa,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else if (session()->get('level') == "Guru") {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_guru = session()->get('id_guru');
            $row = $model->getDataPerguru($id_guru,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $row = $model->getData($this->tahunajaran);
            $between = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Jadwal Kelas";
        $hover = "Jadwal Kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'relasi', 'name' => 'id_mapel'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $column = ['nama_kelas'];
        $model = new KelasModel();
        $rowKelas = $model->getData();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnGuru = ['nip', 'nama'];
        $modelGuru = new GuruModel();
        $rowGuru = $modelGuru->getDataSelct();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnGuru,
                'rows' => $rowGuru,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new JadwalKelasModel();
        $data->insert([
            'id_kelas' => $this->request->getPost('id_kelas'),
            'id_guru' => $this->request->getPost('id_guru'),
            'id_mapel' => $this->request->getPost('id_mapel'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'hari' => $this->request->getPost('hari'),
            'id_tahun_ajaran' => $this->idTahunAjaran
        ]);
        session()->setFlashdata("success", "Berhasil tambah data");
        return redirect('jadwal_kelas');
    }

    public function edit($id)
    {
        $data = "Edit Jadwal Kelas";
        $hover = "Jadwal Kelas";
        $page = "jadwal_kelas";
        $model = new JadwalKelasModel();
        $enumValues = $model->getEnumValues('hari');
        $enum = [
            'hari' => $enumValues
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'relasi', 'name' => 'id_kelas'],
            ['type' => 'relasi', 'name' => 'id_mapel'],
            ['type' => 'enum', 'name' => 'hari'],
            ['type' => 'text', 'name' => 'jam'],
        ];
        $dt = $model->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
            ->join('guru', 'guru.id=jadwal_kelas.id_guru')
            ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')->where([
                'jadwal_kelas.id' => $id,
            ])->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel,guru.nip,guru.nama')->first();

        $column = ['nama_kelas'];
        $model = new KelasModel();
        $rowKelas = $model->getData();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $relasi = true;
        $columnGuru = ['nip', 'nama'];
        $modelGuru = new GuruModel();
        $rowGuru = $modelGuru->getDataSelct();
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowKelas,
                'fieldName' => 'id_kelas',
                'select' => ['nama_kelas']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnGuru,
                'rows' => $rowGuru,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new JadwalKelasModel();
        $data->update($id, [
            'hari' => $this->request->getPost('hari'),
            'jam' => $this->request->getPost('jam'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('jadwal_kelas');
    }

    public function delete($id)
    {
        $data = new JadwalKelasModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('jadwal_kelas');
    }

    public function report()
    {
        $hiddenBetween = true;
        if (session()->get('level') == "Siswa") {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_siswa = session()->get('id');
            $row = $model->getDataPersiswa($id_siswa,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
        } else if (session()->get('level') == "Guru") {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_guru = session()->get('id_guru');
            $row = $model->getDataPerguru($id_guru,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
        } else {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $row = $model->getData($this->tahunajaran);
            $between = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'hiddenBetween'));
        }
    }

    public function cetak()
    {
        if (session()->get('level') == "Siswa") {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_siswa = session()->get('id');
            $row = $model->getDataPersiswa($id_siswa,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('laporan/cetak', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else if (session()->get('level') == "Guru") {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $id_guru = session()->get('id_guru');
            $row = $model->getDataPerguru($id_guru,  $this->tahunajaran);
            $between = true;
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('laporan/cetak', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $data = "Jadwal Kelas";
            $hover = "Jadwal Kelas";
            $page = 'jadwal_kelas';
            $model = new JadwalKelasModel();
            $row = $model->getData($this->tahunajaran);
            $between = true;
            $column = ['hari', 'jam', 'nama_kelas', 'nama_mapel', 'nama_guru'];
            return view('laporan/cetak', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }
}
