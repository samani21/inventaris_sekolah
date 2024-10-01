<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangRusakModel;
use App\Models\GuruModel;
use App\Models\MonitoringGuruModel;
use App\Models\SiswaModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\HTTP\ResponseInterface;

class MonitoringGuru extends BaseController
{

    public function index()
    {
        if (session()->get('level') == "Guru") {
            $data = "Monitoring Guru";
            $hover = "Monitoring Guru";
            $page = 'monitoring_guru';
            $model = new MonitoringGuruModel();
            $row = $model->getDataPerguru();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $column = ['tanggal', 'status_kinerja', 'catatan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else if (session()->get('level') == "Kepala Sekolah") {
            $data = "Monitoring Guru";
            $hover = "Monitoring Guru";
            $page = 'monitoring_guru';
            $model = new MonitoringGuruModel();
            $row = $model->getData();
            $hiddenButtonAction = true;
            $hiddenButtonAdd = true;
            $verif = true;
            $column = ['nip', 'nama', 'tanggal', 'status_kinerja', 'catatan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'hiddenButtonAction', 'hiddenButtonAdd', 'verif'));
        } else {
            $data = "Monitoring Guru";
            $hover = "Monitoring Guru";
            $page = 'monitoring_guru';
            $model = new MonitoringGuruModel();
            $row = $model->getData();
            $column = ['nip', 'nama', 'tanggal', 'status_kinerja', 'catatan'];
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page'));
        }
    }

    public function tambah()
    {
        $data = "Tambah Monitoring Guru";
        $hover = "Monitoring Guru";
        $page = 'monitoring_guru';
        $model = new MonitoringGuruModel();
        $status_kinerja = $model->getEnumKategori('status_kinerja');
        $enum = [
            'status_kinerja' => $status_kinerja,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'status_kinerja'],
            ['type' => 'textArea', 'name' => 'catatan'],
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
        $data = new MonitoringGuruModel();
        $data->insert([
            'id_guru' => $this->request->getPost('id_guru'),
            'tanggal' => $this->request->getPost('tanggal'),
            'status_kinerja' => $this->request->getPost('status_kinerja'),
            'catatan' => $this->request->getPost('catatan'),
        ]);
        session()->setFlashdata("success", "Berhasil Tambah data");
        return redirect('monitoring_guru');
    }


    public function edit($id)
    {
        $data = "Edit Monitoring Guru";
        $hover = "Monitoring Guru";
        $page = 'monitoring_guru';
        $model = new MonitoringGuruModel();
        $status_kinerja = $model->getEnumKategori('status_kinerja');
        $enum = [
            'status_kinerja' => $status_kinerja,
        ];
        $form = [
            ['type' => 'relasi', 'name' => 'id_guru'],
            ['type' => 'date', 'name' => 'tanggal'],
            ['type' => 'enum', 'name' => 'status_kinerja'],
            ['type' => 'textArea', 'name' => 'catatan'],
        ];
        $dt = $model->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->where([
                'monitoring_guru.id' => $id,
            ])
            ->select('guru.nama,guru.nip,monitoring_guru.*')->first();

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
        $data = new MonitoringGuruModel();
        $data->update($id, [
            'tanggal' => $this->request->getPost('tanggal'),
            'status_kinerja' => $this->request->getPost('status_kinerja'),
            'catatan' => $this->request->getPost('catatan'),
        ]);
        session()->setFlashdata("success", "Berhasil update data");
        return redirect('monitoring_guru');
    }

    public function verifikasi($id)
    {
        $data = new MonitoringGuruModel();
        $data->update($id, [
            'id_user_verifikasi' => session()->get('id'),
        ]);
        session()->setFlashdata("success", "Berhasil Verifikasi data");
        return redirect('monitoring_guru');
    }


    public function delete($id)
    {
        $data = new MonitoringGuruModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect('monitoring_guru');
    }

    public function laporan_sumber()
    {
        $data = "Laporan Sumber Barang";
        $hover = "Laporan Sumber Barang";
        $dt = new MonitoringGuruModel();
        $d_bmp = $dt->getPemerintah();
        return view('monitoring_guru/laporan_sumber', compact('data', 'hover', 'd_bmp'));
    }

    public function cetak_sumber()
    {
        $dari = $this->request->getPost('dari');
        $sampai = $this->request->getPost('sampai');
        return view('monitoring_guru/cetak_sumber', compact('dari', 'sampai'));
    }
}
