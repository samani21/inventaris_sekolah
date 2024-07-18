<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_kelas'];


    public function getData()
    {
        return $this->findAll();
    }
}
