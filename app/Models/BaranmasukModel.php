<?php

namespace App\Models;

use CodeIgniter\Model;

class BaranmasukModel extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang_masuk';
    protected $allowedFields    = ['id_barang_masuk', 'id_barang', 'tgl', 'total', 'status'];

    public function getData()
    {
        return $this->findAll();
    }

    public function getbarang1()
    {
        return $this->db->table('barang_masuk')->select('barang.kode_barang,barang.nama_barang,barang.merek,barang_masuk.tgl as tanggal,barang_masuk.total,barang_masuk.status,barang_masuk.id_barang_masuk as id')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->get()->getResultArray();
    }
    public function getbarangrelasi($id)
    {
        return $this->db->table('barang_masuk')->join('barang', 'barang.id=barang_masuk.id_barang')->where('id_barang_masuk', $id)
            ->get()->getResultArray();
    }
    public function getbarang2($dari, $sampai)
    {
        return $this->db->table('barang_masuk')->select('barang.kode_barang,barang.nama_barang,barang.merek,barang_masuk.tgl as tanggal,barang_masuk.total,barang_masuk.status,barang_masuk.id_barang_masuk as id')
            ->join('barang', 'barang.id=barang_masuk.id_barang')->where("tgl BETWEEN '$dari' AND '$sampai'")
            ->get()->getResultArray();
    }

    public function getPemerintah()
    {
        return $this->db->table('barang_masuk')->join('barang', 'barang.id=barang_masuk.id_barang')
            ->get()->getResultArray();
    }

    public function getPembelian()
    {
        return $this->db->table('barang_masuk')->join('barang', 'barang.id=barang_masuk.id_barang')->where('status', 'Pembelian')
            ->get()->getResultArray();
    }

    public function kurangStok($id, $totalBaru)
    {
        $item = $this->find($id);
        if ($item) {
            $item['total'] =  $item['total'] - $totalBaru;
            return $this->update($id, ['total' => $item['total']]);
        }
        return false;
    }

    public function updateStock($id, $totalAwal, $totalAkhir)
    {
        $item = $this->find($id);
        if ($item) {
            $item['total'] =  $item['total'] + $totalAwal - $totalAkhir;
            return $this->update($id, ['total' => $item['total']]);
        }
        return false;
    }

    public function updateStockBaik($id, $totalAwal, $totalAkhir)
    {
        $item = $this->find($id);
        if ($item) {
            $item['total'] =  $item['total'] - $totalAwal + $totalAkhir;
            return $this->update($id, ['total' => $item['total']]);
        }
        return false;
    }

    public function deleteStock($id, $totalAkhir)
    {
        $item = $this->find($id);
        if ($item) {
            $item['total'] =  $item['total']  + $totalAkhir;
            return $this->update($id, ['total' => $item['total']]);
        }
        return false;
    }

    public function barangBaik($id, $totalBaru)
    {
        $item = $this->find($id);
        if ($item) {
            $item['total'] =  $item['total'] + $totalBaru;
            return $this->update($id, ['total' => $item['total']]);
        }
        return false;
    }
}
