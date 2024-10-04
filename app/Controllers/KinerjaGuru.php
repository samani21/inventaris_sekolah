<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\KinerjaGuruModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class KinerjaGuru extends BaseController
{
    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getDataPerguru();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $download = true;
            $column = ['tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd', 'download'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $verif = true;
            $download = true;
            $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd', 'verif', 'download'));
        } else {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getData();
            $download = true;
            $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'download'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Kinerja Guru";
        $hover = "Kinerja Guru";
        $page = 'kinerja_guru';
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'kompetensi_pedagogik'],
            ['type' => 'number', 'name' => 'kompetensi_kepribadian'],
            ['type' => 'number', 'name' => 'kompetensi_profesional'],
            ['type' => 'number', 'name' => 'kompetensi_sosial'],
            ['type' => 'textArea', 'name' => 'keterangan'],
            ['type' => 'file', 'name' => 'file'],
        ];
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
        $notRequired = true;
        return view('main/tambah', compact('data', 'hover', 'page', 'form', 'enum', 'relasi', 'notRequired'));
    }

    public function store()
    {
        $data = new KinerjaGuruModel();
        $dataBerkas = $this->request->getFile('file');
        $fileName = $dataBerkas->getRandomName();
        if ($dataBerkas == "") {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
                'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
                'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
                'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);
        } else {
            $data->insert([
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
                'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
                'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
                'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
                'keterangan' => $this->request->getPost('keterangan'),
                'file' => $fileName
            ]);
            $dataBerkas->move('public/file', $fileName);
        }
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('kinerja_guru');
    }


    public function edit($id)
    {
        $data = "Edit Kinerja Guru";
        $hover = "Kinerja Guru";
        $page = 'kinerja_guru';
        $model = new KinerjaGuruModel();
        $enum = [];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'number', 'name' => 'kompetensi_pedagogik'],
            ['type' => 'number', 'name' => 'kompetensi_kepribadian'],
            ['type' => 'number', 'name' => 'kompetensi_profesional'],
            ['type' => 'number', 'name' => 'kompetensi_sosial'],
            ['type' => 'textArea', 'name' => 'keterangan'],
            ['type' => 'file', 'name' => 'file'],
        ];
        $dt = $model->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->where([
                'kinerja_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,kinerja_guru.*')->first();

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
        $data = new KinerjaGuruModel();
        $foto = $this->request->getPost('file');
        $dataBerkas = $this->request->getFile('file');
        if ($dataBerkas == "") {
            $data->update($id, [
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
                'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
                'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
                'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
                'keterangan' => $this->request->getPost('keterangan'),
            ]);
        } else {
            $fileName = $dataBerkas->getRandomName();
            $data->update($id, [
                'id_guru' => $this->request->getPost('id_guru'),
                'tanggal' => $this->request->getPost('tanggal'),
                'kompetensi_pedagogik' => $this->request->getPost('kompetensi_pedagogik'),
                'kompetensi_kepribadian' => $this->request->getPost('kompetensi_kepribadian'),
                'kompetensi_profesional' => $this->request->getPost('kompetensi_profesional'),
                'kompetensi_sosial' => $this->request->getPost('kompetensi_sosial'),
                'keterangan' => $this->request->getPost('keterangan'),
                'file' => $fileName
            ]);
            $dataBerkas->move('public/file', $fileName);
        }

        session()->setFlashdata("success", "Berhasil update data");
        return redirect('kinerja_guru');
    }

    public function verifikasi($id)
    {
        $data = new KinerjaGuruModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('kinerja_guru');
    }


    public function delete($id)
    {
        $data = new KinerjaGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('kinerja_guru');
    }

    public function report()
    {
        if (session()->get('level') == "Guru") {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getDataPerguru();
            $column = ['tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];

            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        } else {
            $data = "Kinerja Guru";
            $hover = "Kinerja Guru";
            $page = 'kinerja_guru';
            $model = new KinerjaGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
            return view('main/laporan', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function cetak()
    {
        $dari = $this->request->getVar('dari');
        $sampai = $this->request->getVar('sampai');
        $data = "Kinerja Guru";
        if (session()->get('level') == "Guru") {
            if ($dari && $sampai) {
                $column = ['tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
                $model = new KinerjaGuruModel();
                $row = $model->cetakDataBeetwenGuru($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new KinerjaGuruModel();
                $row = $model->cetakDataPerguru();
                $column = ['tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        } else {
            if ($dari && $sampai) {
                $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
                $model = new KinerjaGuruModel();
                $row = $model->cetakDataBeetwen($dari, $sampai);
                return view('laporan/cetak', compact('dari', 'sampai', 'column', 'row', 'data'));
            } else {
                $model = new KinerjaGuruModel();
                $row = $model->cetakData();
                $column = ['nip', 'nama', 'tanggal', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'keterangan'];
                return view('laporan/cetak', compact('column', 'row', 'data'));
            }
        }
    }
}
