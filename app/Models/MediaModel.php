<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table            = 'media';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['media'];


    public function getData()
    {
        return $this->findAll();
    }
}
