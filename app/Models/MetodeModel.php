<?php

namespace App\Models;

use CodeIgniter\Model;

class MetodeModel extends Model
{
    protected $table            = 'metode';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['metode'];


    public function getData()
    {
        return $this->findAll();
    }
}
