<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MetodeModel;
use App\Models\PelaksanaanPembelajaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class PelaksanaanPembelajaran  extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $statusVerif = "id_user_verifikasi";
            $fotoVideo = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif', 'fotoVideo'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getData();
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $verif = true;
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $fotoVideo = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction', 'verif', 'fotoVideo'));
        } else {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $statusVerif = "id_user_verifikasi";
            $fotoVideo = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif', 'fotoVideo'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Pelaksanaan Pembelajaran";
        $hover = "Pelaksanaan Pembelajaran";
        $page = 'pelaksanaan_pembelajaran';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
                ['type' => 'file', 'name' => 'foto/video'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
                ['type' => 'file', 'name' => 'foto/video'],
            ];
        }
        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMetode = ['metode'];
        $modelMetode = new MetodeModel();
        $rowMetode = $modelMetode->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnMetode,
                'rows' => $rowMetode,
                'fieldName' => 'id_metode',
                'select' => ['metode']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PelaksanaanPembelajaranModel();
        $dataBerkas = $this->request->getFile('foto/video');
        $fileName = $dataBerkas->getRandomName();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
                'foto/video' => $fileName
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
                'foto/video' => $fileName
            ]);
        }
        $dataBerkas->move('public/images', $fileName);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('pelaksanaan_pembelajaran');
    }


    public function edit($id)
    {
        $data = "Edit Pelaksanaan Pembelajaran";
        $hover = "Pelaksanaan Pembelajaran";
        $page = 'pelaksanaan_pembelajaran';
        $model = new PelaksanaanPembelajaranModel();
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
                ['type' => 'file', 'name' => 'foto/video'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_metode'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'evaluasi'],
                ['type' => 'file', 'name' => 'foto/video'],
            ];
        }
        $dt = $model->join('guru', 'guru.id=pelaksanaan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=pelaksanaan_pembelajaran.id_mapel')
            ->join('metode', 'metode.id=pelaksanaan_pembelajaran.id_metode')
            ->where([
                'pelaksanaan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,pelaksanaan_pembelajaran.*,users.level,mapel.nama_mapel,metode')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMetode = ['metode'];
        $modelMetode = new MetodeModel();
        $rowMetode = $modelMetode->getData();
        $relasi = true;
        $relasi = [
            [
                'columns' => $column,
                'rows' => $rowRelasi,
                'fieldName' => 'id_guru',
                'select' => ['nip', 'nama']
            ],
            [
                'columns' => $columnMapel,
                'rows' => $rowMapel,
                'fieldName' => 'id_mapel',
                'select' => ['nama_mapel']
            ],
            [
                'columns' => $columnMetode,
                'rows' => $rowMetode,
                'fieldName' => 'id_metode',
                'select' => ['metode']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $foto = $this->request->getPost('foto/video');
        $dataBerkas = $this->request->getFile('foto/video');
        if ($dataBerkas == "") {
            $data->update($id, [
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $data->update($id, [
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_metode' => $this->request->getPost('id_metode'),
                'evaluasi' => $this->request->getPost('evaluasi'),
                'foto/video' => $fileName,
            ]);
            $dataBerkas->move('public/images', $fileName);
        }
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('pelaksanaan_pembelajaran');
    }

    public function verifikasi($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('pelaksanaan_pembelajaran');
    }

    public function reject($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $data->update($id, [
            'id_user_verifikasi' => 0,
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('pelaksanaan_pembelajaran');
    }

    public function delete($id)
    {
        $data = new PelaksanaanPembelajaranModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('pelaksanaan_pembelajaran');
    }

    public function report()
    {
        if (session()->get('level') == "Guru") {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        } else {
            $data = "Pelaksanaan Pembelajaran";
            $hover = "Pelaksanaan Pembelajaran";
            $page = 'pelaksanaan_pembelajaran';
            $model = new PelaksanaanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi', 'foto/video'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Pelaksanaan Pembelajaran";
        if (session()->get('level') == "Guru") {
            if ($dari && $sampai) {
                $column = ['nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
                $model = new PelaksanaanPembelajaranModel();
                $row = $model->cetakDataBeetwenGuru($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PelaksanaanPembelajaranModel();
                $row = $model->cetakDataPerguru();
                $column = ['nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
                $model = new PelaksanaanPembelajaranModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PelaksanaanPembelajaranModel();
                $row = $model->cetakData();
                $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }

    public function cetakSatuan($id)
    {
        $data = "Pelaksanaan Pembelajaran";
        $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'metode', 'evaluasi'];
        $model = new PelaksanaanPembelajaranModel();
        $row = $model->join('guru', 'guru.id=pelaksanaan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=pelaksanaan_pembelajaran.id_mapel')
            ->join('metode', 'metode.id=pelaksanaan_pembelajaran.id_metode')
            ->where([
                'pelaksanaan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,pelaksanaan_pembelajaran.*,users.level,mapel.nama_mapel,metode')->first();
        $ttd = $model->join('users', 'users.id=pelaksanaan_pembelajaran.id_user_verifikasi')
            ->join('guru', 'guru.user_id=users.id')
            ->where([
                'pelaksanaan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip')->first();
        return view('laporan/cetakSatuan', compact('column', 'row', 'ttd', 'data'));
    }
}
