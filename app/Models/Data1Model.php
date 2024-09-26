<?php

namespace App\Models;

use CodeIgniter\Model;

class Data1Model extends Model
{
    protected $table            = 'data1';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama', 'tanggal', 'tempat', 'alamat', 'umur','id_data1'];


    public function getData()
    {
        return $this->findAll();
    }

    public function getEnumAgama($field)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM {$this->table} LIKE '{$field}'");
        $row = $query->getRow();

        if ($row) {
            // Extract enum values
            preg_match("/^enum\((.*)\)$/", $row->Type, $matches);
            $enum = str_getcsv($matches[1], ',', "'");
            return $enum;
        }

        return [];
    }

}
