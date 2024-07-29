<?php

namespace App\Models;

use CodeIgniter\Model;

class InovasiGuruModel extends Model
{
    protected $table            = 'inovasi_guru';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'tanggal', 'inovasi', 'kreativitas', 'etika', 'profesionalisme', 'masukkan'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=inovasi_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,inovasi_guru.*,users.level')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=inovasi_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,inovasi_guru.*,users.level')->where('guru.id', session()->get('id_guru'))->findAll();
    }
}