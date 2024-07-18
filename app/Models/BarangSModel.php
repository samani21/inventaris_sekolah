<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangSModel extends Model
{
    protected $table            = 'barang_status';
    protected $primaryKey       = 'id_barang_status';
    protected $allowedFields    = ['id_barang_status', 'id_barang', 'keterangan', 'status', 'stok', 'tgl'];


    public function getBarangStatus()
    {
        return $this->findAll();
    }

    public function getbarang2()
    {
        return $this->db->table('barang_status')->select(
            'barang.kode_barang,barang.nama_barang,barang_status.*,barang_status.id_barang_status as id,barang_status.tgl as tanggal,barang_status.keterangan,barang_status.status'
        )->join('barang', 'barang.id=barang_status.id_barang')
            ->get()->getResultArray();
    }

    public function getbarangrusakk()
    {
        return $this->db->table('barang_status')->join('barang', 'barang.id=barang_status.id_barang')->where('status', 'Baik')
            ->get()->getResultArray();
    }

    public function getbarangbaik()
    {
        return $this->db->table('barang_status')->join('barang', 'barang.id=barang_status.id_barang')
            ->get()->getResultArray();
    }

    public function getbarangbaik3()
    {
        return $this->db->table('barang_status')->join('barang', 'barang.id=barang_status.id_barang')->where('status', "Rusak")
            ->get()->getResultArray();
    }

    public function getbarangbaik1($dari, $sampai, $status)
    {
        return $this->db->table('barang_status')->join('barang', 'barang.id=barang_status.id_barang')->where("tgl BETWEEN '$dari' AND '$sampai'")->where("status", $status)
            ->get()->getResultArray();
    }

    public function getEnumStatus($field)
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
