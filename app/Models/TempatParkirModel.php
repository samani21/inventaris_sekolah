<?php

namespace App\Models;

use CodeIgniter\Model;

class TempatParkirModel extends Model
{
    protected $table            = 'tempat_parkir';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_tempat', 'alamat', 'kapasitas_total', 'kapasitas_terpakai', 'status_operasional'];


    public function getData()
    {
        return $this->findAll();
    }


    public function getEnumValues($field)
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
