<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiSiswaModel extends Model
{
    protected $table            = 'prestasi_siswa';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_siswa', 'tanggal', 'tingkat', 'pencapaian'];


    public function getData()
    {
        if (session()->get('level') == "Siswa") {
            return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
                ->select('siswa.nama,siswa.nis,prestasi_siswa.*')->where('siswa.id', session()->get('id_siswa'))->findAll();
        } else {
            return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
                ->select('siswa.nama,siswa.nis,prestasi_siswa.*')->findAll();
        }
    }

    public function cetakDataBeetwen($dari, $sampai)
    {
        return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
            ->select('siswa.nama,siswa.nis,prestasi_siswa.*')
            ->where("prestasi_siswa.tanggal BETWEEN '$dari' AND '$sampai'")
            ->findAll();
    }

    public function cetakDataBeetwenSiswa($dari, $sampai)
    {
        return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
            ->select('siswa.nama,siswa.nis,prestasi_siswa.*')
            ->where("prestasi_siswa.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('siswa.id', session()->get('id_siswa'))
            ->findAll();
    }

    public function cetakDataPerSiswa()
    {
        return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
            ->select('siswa.nama,siswa.nis,prestasi_siswa.*')
            ->where('siswa.id', session()->get('id_siswa'))->findAll();
    }
    public function cetakData()
    {
        return $this->join('siswa', 'siswa.id=prestasi_siswa.id_siswa')
            ->select('siswa.nama,siswa.nis,prestasi_siswa.*')->findAll();
    }
}
