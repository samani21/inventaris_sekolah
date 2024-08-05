<?php

namespace App\Models;

use CodeIgniter\Model;

class EkstrakurikulerSiswaModel extends Model
{
    protected $table            = 'ekskul_siswa';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_siswa', 'id_ekskul', 'tanggal_bergabung'];


    public function getData()
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')->findAll();
    }

    public function reportDataPersiswa()
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')
            ->where('id_siswa', session()->get('id_siswa'))
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')->findAll();
    }

    public function cetakBetween($dari, $sampai)
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')
            ->where("tanggal_bergabung BETWEEN '$dari' AND '$sampai'")->findAll();
    }

    public function cetakDatapersiswa()
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')
            ->where('id_siswa', session()->get('id_siswa'))->findAll();
    }

    public function cetakBetweenpersiswa($dari, $sampai)
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')
            ->where('id_siswa', session()->get('id_siswa'))
            ->where("tanggal_bergabung BETWEEN '$dari' AND '$sampai'")->findAll();
    }

    public function getDataPersiswa($kegiatan)
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')->where('id_siswa', session()->get('id_siswa'))
            ->where('ekskul.kegiatan', $kegiatan)
            ->select('kegiatan,ekskul_siswa.*')
            ->findAll();
    }

    public function getDataEkskul($kegiatan)
    {
        return $this->join('ekskul', 'ekskul.id=ekskul_siswa.id_ekskul')
            ->join('siswa', 'siswa.id=ekskul_siswa.id_siswa')->where('ekskul.kegiatan', $kegiatan)
            ->select('kegiatan,ekskul_siswa.*,siswa.nis,siswa.nama')
            ->findAll();
    }
}
