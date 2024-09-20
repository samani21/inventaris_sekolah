<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'nama', 'nik', 'tempat', 'tanggal', 'agama', 'jenis_kelamin', 'no_telepon', 'alamat', 'tanggal_bergabung', 'foto'];


    public function getData()
    {
        return $this->join('users', 'users.id = pegawai.user_id')
            ->select('concat(tempat, ",", tanggal) as ttl, pegawai.id, nik, nama, tempat, jenis_klamin, agama, no_telepon, foto, role, alamat, tanggal_bergabung')
            ->where('users.role !=', 'Petugas Parkir')
            ->where('users.role !=', 'Masyrakat')  // Exclude rows where role is 'Admin'
            ->findAll();
    }

    public function getDataPetugasParkir()
    {
        return $this->join('users', 'users.id=pegawai.user_id')
            ->select('concat(tempat,",",tanggal) as ttl,pegawai.id,nik,nama,tempat,jenis_klamin,agama,no_telepon,foto,role,alamat,tanggal_bergabung')->where('users.role', 'Petugas Parkir')->findAll();
    }

    public function getDataSelct()
    {
        return $this->join('users', 'users.id=pegawai.user_id')
            ->select('concat(tempat,",",tanggal) as ttl,pegawai.id,nik,nama,tempat,jenis_klamin,agama,no_telepon,foto,role,alamat,tanggal_bergabung')->where('role', 'Petugas Parkir')->findAll();
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
