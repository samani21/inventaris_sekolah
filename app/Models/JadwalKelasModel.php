<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKelasModel extends Model
{
    protected $table = 'jadwal_kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'hari', 'jam', 'id_kelas', 'id_mapel'];

    public function getData()
    {
        return $this->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
            ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')
            ->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel')->findAll();
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
