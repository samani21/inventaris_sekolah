<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangBaikModel extends Model
{
    protected $table            = 'barang_perbaikan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_barang_rusak', 'tanggal', 'total', 'biaya'];


    public function getData()
    {
        return $this->join('barang_rusak', 'barang_rusak.id=barang_perbaikan.id_barang_rusak')
            ->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_rusak.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->select('barang.kode_barang,barang.nama_barang,barang_masuk.status,barang_perbaikan.*')->findAll();
    }
}
