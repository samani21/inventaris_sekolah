<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'foto', 'nip', 'nama', 'tempat', 't_lahir', 'j_kelamin', 'agama', 'no_hp', 'id_guru'];


    public function getData()
    {
        return $this->join('users', 'users.id=guru.user_id')
            ->select('concat(tempat,",",t_lahir) as ttl,guru.id,nip,nama,tempat,j_kelamin as jenis_kelamin,agama,no_hp,foto,level')->findAll();
    }

    public function getDataSelct()
    {
        return $this->join('users', 'users.id=guru.user_id')
            ->select('concat(tempat,",",t_lahir) as ttl,guru.id,nip,nama,tempat,j_kelamin as jenis_kelamin,agama,no_hp,foto,level')->where('level', 'Guru')->findAll();
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

    public function getEnumJenisKelamin($field)
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
