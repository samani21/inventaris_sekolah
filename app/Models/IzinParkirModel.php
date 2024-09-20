<?php

namespace App\Models;

use CodeIgniter\Model;

class IzinParkirModel extends Model
{
    protected $table            = 'izin_parkir';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_tempat_parkir', 'id_petugas', 'tanggal_mulai', 'tanggal_selesai', 'status_izin', 'jenis'];


    public function getData()
    {
        if (session()->get('role') == "Petugas Parkir") {
            return $this->join('tempat_parkir', 'tempat_parkir.id=izin_parkir.id_tempat_parkir')
                ->join('pegawai', 'pegawai.id=izin_parkir.id_petugas')
                ->select('izin_parkir.*,pegawai.nama,pegawai.nik,tempat_parkir.nama_tempat,tempat_parkir.alamat,tempat_parkir.status_operasional,izin_parkir.status_izin as status')
                ->where('id_petugas', session()->get('id_pegawai'))->findAll();
        } else {
            return $this->join('tempat_parkir', 'tempat_parkir.id=izin_parkir.id_tempat_parkir')
                ->join('pegawai', 'pegawai.id=izin_parkir.id_petugas')
                ->select('izin_parkir.*,pegawai.nama,pegawai.nik,tempat_parkir.nama_tempat,tempat_parkir.alamat,tempat_parkir.status_operasional,izin_parkir.status_izin as status')->findAll();
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
