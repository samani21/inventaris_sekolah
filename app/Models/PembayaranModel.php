<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_siswa', 'id_tahun_ajaran', 'tanggal', 'jenis', 'pembayaran_ke', 'jumlah'];


    public function getData()
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->select('siswa.nama,siswa.nis,pembayaran.*')->findAll();
    }

    public function getDataPersemester($id_tahun_ajaran)
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')->where('id_tahun_ajaran', $id_tahun_ajaran)->findAll();
    }
    public function getDataPersemesterSiswa($id_tahun_ajaran)
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->select('siswa.nama,siswa.nis,pembayaran.*')->where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_siswa', session()->get('id_siswa'))->findAll();
    }

    public function getEnumJenis($field)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM {$this->table} LIKE '{$field}'");
        $row = $query->getRow();

        if ($row) {
            // Extract enum values
            preg_match("/^enum\((.*)\)$/", $row->Type, $matches);
            $enum = str_getcsv($matches[1], ',', "'");
            return $enum;
        }

        return [];
    }

    public function cetakDataBeetwen($dari, $sampai)
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')
            ->where("pembayaran.tanggal BETWEEN '$dari' AND '$sampai'")
            ->findAll();
    }

    public function cetakDataBeetwenSiswa($dari, $sampai)
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')
            ->where("pembayaran.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('siswa.id', session()->get('id_siswa'))
            ->findAll();
    }

    public function cetakDataPerSiswa()
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')
            ->where('siswa.id', session()->get('id_siswa'))->findAll();
    }
    public function cetakData()
    {
        return $this->join('siswa', 'siswa.id=pembayaran.id_siswa')
            ->join('tahun_ajaran', 'tahun_ajaran.id=pembayaran.id_tahun_ajaran')
            ->select('siswa.nama,siswa.nis,pembayaran.*,tahun,semester')->findAll();
    }
}
