<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenSiswaModel;
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

class UjianSiswa extends BaseController
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
    public function index($kelas)
    {
        if (session()->get('level') == "Siswa") {
            $tanggal = $this->request->getVar('tanggal');
            $mapel = $this->request->getVar('mapel');
            $namaKelas = ucwords(str_replace('_', ' ', $kelas));
            $data = "Siswa " . $kelas;
            $hover = "Siswa " . $kelas;
            $model = new SiswaPerkelasModel();
            $page = 'siswa/' . $kelas . '/ujian';
            $column = ['nilai_ujian', 'kelas', 'mapel', 'jenis', 'tahun', 'semester'];
            $ceklist = 'hadir';
            if (isset($tanggal) && isset($mapel)) {
                $row = $model->getData($namaKelas, $tanggal, $mapel, $this->idTahunAjaran);
            } else {
                $row = $model->getDataPersiswaUjian($namaKelas, $tanggal, $mapel, $this->idTahunAjaran);
            }
            $hiddenEdit = true;
            // $hiddenButtonAdd = true;
            $foto = true;
            $hadir = true;
            $modelMapel = new MapelModel();
            $hiddenButtonAction = true;
            $dtMapel = $modelMapel->getData();
            $hiddenButtonAdd = true;
            return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'dtMapel', 'hiddenButtonAction', 'hiddenButtonAdd'));
        } else {
            $tanggal = $this->request->getVar('tanggal');
            $mapel = $this->request->getVar('mapel');
            $namaKelas = ucwords(str_replace('_', ' ', $kelas));
            $data = "Siswa " . $kelas;
            $hover = "Siswa " . $kelas;
            $model = new SiswaPerkelasModel();
            $page = 'siswa/' . $kelas . '/ujian';
            $column = ['nis', 'nama', 'jenis_kelamin', 'kelas'];
            $ujian = true;
            $hiddenButtonAdd = true;
            if (isset($tanggal) && isset($mapel)) {
                $ceklist = 'hadir';
                $row = $model->getData($namaKelas, $tanggal, $mapel, $this->tahunajaran);
                $hiddenEdit = true;
                // $hiddenButtonAdd = true;
                $foto = true;
                $hadir = true;
                $modelMapel = new MapelModel();
                $dtMapel = $modelMapel->getData();
                return view('main/list', compact('data', 'hover', 'row', 'column', 'page', 'foto', 'ceklist', 'hiddenEdit', 'hadir', 'ujian', 'dtMapel', 'hiddenButtonAdd'));
            } else {
                $row = $model->getDataKelas($namaKelas, $this->tahunajaran);
                $hiddenEdit = true;
                // $hiddenButtonAdd = true;
                $foto = true;

                $modelMapel = new MapelModel();
                $dtMapel = $modelMapel->getData();
                return view('main/list', compact('data', 'hover', 'row', 'ujian', 'column', 'page', 'foto', 'hiddenEdit', 'dtMapel', 'hiddenButtonAdd'));
            }
        }
    }
    public function ceklist($kelas, $id)
    {
        $tanggal = $this->request->getVar('tanggal');
        $mapel = $this->request->getVar('mapel');
        $penilaian = $this->request->getVar('penilaian');
        $status = $this->request->getVar('status');
        $modelMapel = new MapelModel();
        $idMapel = $modelMapel->where('nama_mapel', $mapel)->first();
        $data = new AbsenSiswaModel();
        $data->insert([
            'id_siswa_perkelas' => $id,
            'id_tahun_ajaran' => $this->idTahunAjaran,
            'tanggal' => $tanggal,
            'hadir' => 1,
            'id_mapel' => $idMapel['id'],
            'id_guru' => session()->get('id_guru'),
            'status' => $status
        ]);

        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->to('/siswa_perkelas/' . $kelas . '/ujian?tanggal=' . $tanggal . '&mapel=' . $mapel . '&penilaian=' . $penilaian);
    }

    public function updateCeklist($kelas, $id)
    {
        $status = $this->request->getVar('status');
        $data = new AbsenSiswaModel();
        $data->update($id, [
            'status' => $status,
        ]);

        session()->setFlashdata("success", "Berhasil update data");
        return redirect()->back();
    }


    public function nilai($id)
    {
        $tanggal = $this->request->getPost('tanggal');
        $mapel = $this->request->getPost('mapel');
        $penilaian = $this->request->getPost('penilaian');
        $nilai = $this->request->getPost('nilai');
        $materi = $this->request->getPost('materi');
        $data = new NilaiUjianModel();
        $nilaiharian = $data->where('id_absen_siswa', $id)->first();
        if (isset($nilaiharian)) {
            $data->update($nilaiharian['id'], [
                'nilai' => $nilai,
            ]);
        } else {
            $siswaPerkerlas = new AbsenSiswaModel();
            $absenSiswa = $siswaPerkerlas->join('siswa_perkelas', 'siswa_perkelas.id=absen_siswa.id_siswa_perkelas')->where('absen_siswa.id', $id)->select('id_siswa')->first();
            $modelPembayaran = new PembayaranModel();
            $pembayaran = $modelPembayaran->select('SUM(pembayaran_ke) as total')->where('id_tahun_ajaran', $this->idTahunAjaran)->where('id_siswa', $absenSiswa['id_siswa'])->first();

            if ($pembayaran['total'] > 2 && $penilaian == "PTS") {
                $data->insert([
                    'id_absen_siswa' => $id,
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'tanggal' => $tanggal,
                    'nilai' => $nilai,
                    'jenis' => $penilaian,
                ]);
            } else if ($pembayaran['total'] > 5 && $penilaian == "PAS") {
                $data->insert([
                    'id_absen_siswa' => $id,
                    'id_tahun_ajaran' => $this->idTahunAjaran,
                    'tanggal' => $tanggal,
                    'nilai' => $nilai,
                    'jenis' => $penilaian,
                ]);
            } else {
                session()->setFlashdata("failed", "SPP YANG DIBAYAR TIDAK MENCUKUPI");
                return redirect()->back();
            }
        }

        session()->setFlashdata("success", "Berhasil tambah nilai");
        return redirect()->back();
    }
    public function delete($kelas, $id)
    {
        $data = new SiswaPerkelasModel();
        $data->delete($id);
        session()->setFlashdata("success", "Berhasil hapus data");
        return redirect()->back();
    }
}
