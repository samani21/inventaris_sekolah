<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiGuruModel extends Model
{
    protected $table            = 'prestasi_guru';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'tanggal', 'tingkat', 'pencapaian'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=prestasi_guru.id_guru')
            ->select('guru.nama,guru.nip,prestasi_guru.*')->findAll();
    }
}
