<?php

namespace App\Models;

use CodeIgniter\Model;

class BaranmasukModel extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id_barang_masuk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang_nasuk','id_barang','tgl','total','harga','status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getBarangmasuk()
    {
        return $this->findAll();
    }

    public function getbarang1(){
        return $this->db->table('barang_masuk')->join('barang','barang.id=barang_masuk.id_barang')
        ->get()->getResultArray();
    }

    public function getPemerintah(){
        return $this->db->table('barang_masuk')->join('barang','barang.id=barang_masuk.id_barang')->where('status','Pemerintah')
        ->get()->getResultArray();
    }

    public function getPembelian(){
        return $this->db->table('barang_masuk')->join('barang','barang.id=barang_masuk.id_barang')->where('status','Pembelian')
        ->get()->getResultArray();
    }
}
