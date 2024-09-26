<?php

namespace App\Models;

use CodeIgniter\Model;

class Data2Model extends Model
{
    protected $table            = 'data2';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['jabatan', 'foto', 'id_data1'];


    public function getData()
    {
        return $this->join('data1', 'data1.id=data2.id_data1')->select('nama,tanggal,agama,tempat,alamat,umur,data2.*')->findAll();
    }
}
