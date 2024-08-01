<?php

namespace App\Models;

use CodeIgniter\Model;

class SikapPrilakuKedisiplinanModel extends Model
{
    protected $table            = 'sikap_perilaku_kedisiplinan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'tanggal', 'sikap', 'prilaku', 'kedisiplinan', 'masukkan', 'id_user_verifikasi'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=sikap_perilaku_kedisiplinan.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,sikap_perilaku_kedisiplinan.*,users.level')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=sikap_perilaku_kedisiplinan.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,sikap_perilaku_kedisiplinan.*,users.level')->where('guru.id', session()->get('id_guru'))->findAll();
    }

      public function getChart()
    {
        return $this->where('id_guru', session()->get('id_guru'))
            ->groupStart()
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')
            ->groupEnd()
            ->findAll();
    }

}
