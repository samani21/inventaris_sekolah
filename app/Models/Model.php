<?php

namespace App\Models;

use CodeIgniter\Model;

class RetribusiParkirModel extends Model
{
    protected $table            = 'retribusi_parkir';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_tempat_parkir', 'id_petugas', 'jumlah', 'tanggal_retribusi', 'bukti', 'status'];


    public function getData()
    {
        if (session()->get('role') == "Petugas Parkir") {
            return $this->join('tempat_parkir', 'tempat_parkir.id=retribusi_parkir.id_tempat_parkir')
                ->join('pegawai', 'pegawai.id=retribusi_parkir.id_petugas')
                ->select('retribusi_parkir.*,pegawai.nama,pegawai.nik,tempat_parkir.nama_tempat,tempat_parkir.alamat,tempat_parkir.status_operasional,retribusi_parkir.bukti as foto')
                ->where('id_petugas', session()->get('id_pegawai'))->findAll();
        } else {
            return $this->join('tempat_parkir', 'tempat_parkir.id=retribusi_parkir.id_tempat_parkir')
                ->join('pegawai', 'pegawai.id=retribusi_parkir.id_petugas')
                ->select('retribusi_parkir.*,pegawai.nama,pegawai.nik,tempat_parkir.nama_tempat,tempat_parkir.alamat,tempat_parkir.status_operasional,retribusi_parkir.bukti as foto')->findAll();
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
