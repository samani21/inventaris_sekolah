<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaksanaanPembelajaranModel extends Model
{
    protected $table            = 'pelaksanaan_pembelajaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'id_mapel', 'materi', 'tanggal', 'id_metode', 'evaluasi'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=pelaksanaan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=pelaksanaan_pembelajaran.id_mapel')
            ->join('metode', 'metode.id=pelaksanaan_pembelajaran.id_metode')
            ->select('guru.nama,guru.nip,pelaksanaan_pembelajaran.*,users.level,mapel.nama_mapel,metode.metode')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=pelaksanaan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=pelaksanaan_pembelajaran.id_mapel')
            ->join('metode', 'metode.id=pelaksanaan_pembelajaran.id_metode')
            ->select('guru.nama,guru.nip,pelaksanaan_pembelajaran.*,users.level,mapel.nama_mapel,metode.metode')->where('guru.id', session()->get('id_guru'))->findAll();
    }
}
