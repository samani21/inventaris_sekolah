<?php

namespace App\Models;

use CodeIgniter\Model;

class KinerjaGuruModel extends Model
{
    protected $table            = 'kinerja_guru';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'kompetensi_pedagogik', 'kompetensi_kepribadian', 'kompetensi_profesional', 'kompetensi_sosial', 'tanggal', 'keterangan', 'id_user_verifikasi', 'file'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')->where('guru.id', session()->get('id_guru'))->findAll();
    }
    public function cetakDataBeetwen($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')
            ->where("kinerja_guru.tanggal BETWEEN '$dari' AND '$sampai'")
            ->findAll();
    }

    public function cetakDataBeetwenGuru($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')
            ->where("kinerja_guru.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('guru.id', session()->get('id_guru'))
            ->findAll();
    }

    public function cetakDataPerguru()
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')
            ->where('guru.id', session()->get('id_guru'))->findAll();
    }
    public function cetakData()
    {
        return $this->join('guru', 'guru.id=kinerja_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,kinerja_guru.*,users.level')->findAll();
    }
}
