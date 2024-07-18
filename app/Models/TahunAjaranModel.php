<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAjaranModel extends Model
{
    protected $table            = 'tahun_ajaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tahun', 'semester', 'aktif'];


    public function getData()
    {
        return $this->orderBy('aktif', 'desc')->findAll();
    }
}
