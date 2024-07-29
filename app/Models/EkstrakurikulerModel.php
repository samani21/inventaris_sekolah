<?php

namespace App\Models;

use CodeIgniter\Model;

class EkstrakurikulerModel extends Model
{
    protected $table            = 'ekskul';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kegiatan'];


    public function getData()
    {
        return $this->findAll();
    }


}
