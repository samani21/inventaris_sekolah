<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\MapelModel;
use App\Models\MediaModel;
use App\Models\PerancaanPersiapanPembelajaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class PerancanaanPembelajaranPersiapan  extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getData();
            $hiddenButtonAdd = true;
            $hiddenButtonAction = true;
            $verif = true;
            $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAdd', 'hiddenButtonAction', 'verif'));
        } else {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            $statusVerif = "id_user_verifikasi";
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'statusVerif'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Persiapan dan Perancanaan Pembelajaran";
        $hover = "Persiapan dan Perancanaan Pembelajaran";
        $page = 'perancaan_persiapan_pembelajaran';
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        }
        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMedia = ['media'];
        $modelMedia = new MediaModel();
        $rowMedia = $modelMedia->getData();
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
                'columns' => $columnMedia,
                'rows' => $rowMedia,
                'fieldName' => 'id_media',
                'select' => ['media']
            ],
        ];

        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi'));
    }

    public function store()
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        if (session()->get('level') == "Guru") {
            $data->insert([
                'id_guru' => session()->get('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_media' => $this->request->getPost('id_media'),
                'tujuan' => $this->request->getPost('tujuan'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'id_mapel' => $this->request->getPost('id_mapel'),
                'materi' => $this->request->getPost('materi'),
                'tanggal' => $this->request->getPost('tanggal'),
                'id_media' => $this->request->getPost('id_media'),
                'tujuan' => $this->request->getPost('tujuan'),
            ]);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('perancaan_persiapan_pembelajaran');
    }


    public function edit($id)
    {
        $data = "Edit Persiapan dan Perancanaan Pembelajaran";
        $hover = "Persiapan dan Perancanaan Pembelajaran";
        $page = 'perancaan_persiapan_pembelajaran';
        $model = new PerancaanPersiapanPembelajaranModel();
        $enum = [];
        if (session()->get('level') == "Guru") {
            $form = [
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relas', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        } else {
            $form = [
                ['type' => 'relasi', 'name' => 'id_guru'],
                ['type' => 'relasi', 'name' => 'id_mapel'],
                ['type' => 'relasi', 'name' => 'id_media'],
                ['type' => 'text', 'name' => 'materi'],
                ['type' => 'date', 'name' => 'tanggal'],
                ['type' => 'textArea', 'name' => 'tujuan'],
            ];
        }
        $dt = $model->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->where([
                'perencanaan_persiapan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')->first();

        $column = ['nip', 'nama', 'ttl', 'level'];
        $model = new GuruModel();
        $rowRelasi = $model->getDataSelct();
        $columnMapel = ['nama_mapel'];
        $modelMapel = new MapelModel();
        $rowMapel = $modelMapel->getData();
        $columnMedia = ['media'];
        $modelMedia = new MediaModel();
        $rowMedia = $modelMedia->getData();
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
                'columns' => $columnMedia,
                'rows' => $rowMedia,
                'fieldName' => 'id_media',
                'select' => ['media']
            ],
        ];
        return view('main/edit', compact('data', 'hover', 'dt', 'page', 'form', 'enum', 'relasi'));
    }

    public function update($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->update($id, [
            'materi' => $this->request->getPost('materi'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_media' => $this->request->getPost('id_media'),
            'tujuan' => $this->request->getPost('tujuan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    public function verifikasi($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    public function reject($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->update($id, [
            'id_user_verifikasi' => 0,
        ]);
        session()->setFlashdata("success", "Berhasil Reject data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    public function delete($id)
    {
        $data = new PerancaanPersiapanPembelajaranModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('perancaan_persiapan_pembelajaran');
    }

    public function report()
    {
        if (session()->get('level') == "Guru") {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getDataPerguru();
            $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        } else {
            $data = "Persiapan dan Perancanaan Pembelajaran";
            $hover = "Persiapan dan Perancanaan Pembelajaran";
            $page = 'perancaan_persiapan_pembelajaran';
            $model = new PerancaanPersiapanPembelajaranModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
            $cetakData = true;
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page', 'cetakData'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Persiapan dan Perancanaan Pembelajaran";
        if (session()->get('level') == "Guru") {
            if ($dari && $sampai) {
                $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
                $model = new PerancaanPersiapanPembelajaranModel();
                $row = $model->cetakDataBeetwenGuru($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PerancaanPersiapanPembelajaranModel();
                $row = $model->cetakDataPerguru();
                $column = ['nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
                $model = new PerancaanPersiapanPembelajaranModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new PerancaanPersiapanPembelajaranModel();
                $row = $model->cetakData();
                $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }

    public function cetakSatuan($id)
    {
        $data = "Persiapan dan Perancanaan Pembelajaran";
        $column = ['nip', 'nama', 'nama_mapel', 'materi', 'tanggal', 'media', 'tujuan'];
        $model = new PerancaanPersiapanPembelajaranModel();
        $row = $model->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->where([
                'perencanaan_persiapan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')->first();
        $ttd = $model->join('users', 'users.id=perencanaan_persiapan_pembelajaran.id_user_verifikasi')
            ->join('guru', 'guru.user_id=users.id')
            ->where([
                'perencanaan_persiapan_pembelajaran.id' => $id,
            ])
            ->select('guru.nama,guru.nip')->first();
        return view('laporan/cetakSatuan', compact('column', 'row', 'ttd', 'data'));
    }
}
