<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangRusakModel extends Model
{
    protected $table            = 'barang_rusak';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_barang_masuk', 'tanggal', 'total', 'keterangan'];


    public function getData()
    {
        return $this->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_rusak.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->join('barang_perbaikan', 'barang_perbaikan.id_barang_rusak=barang_rusak.id')
            ->select('barang.kode_barang,barang.nama_barang,barang_masuk.status,barang_rusak.*,barang_perbaikan.tanggal as tanggal_perbaikan,barang_perbaikan.total as total_perbaikan,barang_perbaikan.biaya as biaya_perbaikan')->findAll();
    }
}
