<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table            = 'mapel';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_mapel'];


    public function getData()
    {
        return $this->findAll();
    }
}
