<?php

namespace App\Models;

use CodeIgniter\Model;

class RuanganModel extends Model
{
    protected $table            = 'ruangan';
    protected $primaryKey       = 'id_ruangan';
    protected $allowedFields    = ['nm_ruangan'];


    public function getData()
    {
        return $this->select('id_ruangan as id,nm_ruangan as nama_ruangan')->findAll();
    }
}
