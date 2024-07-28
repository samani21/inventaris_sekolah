<?php

namespace App\Models;

use CodeIgniter\Model;

class SikapPrilakuKedisiplinanModel extends Model
{
    protected $table            = 'sikap_perilaku_kedisiplinan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'tanggal', 'sikap', 'prilaku', 'kedisiplinan', 'masukkan'];


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
}
