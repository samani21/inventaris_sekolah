<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pengguna', 'id_tempat_parkir', 'tanggal_pengaduan', 'jenis_pengaduan', 'deskripsi_pengaduan', 'status_pengaduan'];


    public function getData()
    {
        if (session()->get('role') == "Pengguna" || session()->get('role') == "Petugas Parkir") {
            return $this->join('tempat_parkir', 'tempat_parkir.id=pengaduan.id_tempat_parkir')
                ->join('users', 'users.id=Pengaduan.id_pengguna')
                ->select('pengaduan.*,users.name,users.email,tempat_parkir.nama_tempat,tempat_parkir.alamat,pengaduan.status_pengaduan as status')
                ->where('id_pengguna', session()->get('id'))->findAll();
        } else {
            return  $this->join('tempat_parkir', 'tempat_parkir.id=pengaduan.id_tempat_parkir')
                ->join('users', 'users.id=Pengaduan.id_pengguna')
                ->select('pengaduan.*,users.name,users.email,tempat_parkir.nama_tempat,tempat_parkir.alamat,pengaduan.status_pengaduan as status')->findAll();
        }
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
