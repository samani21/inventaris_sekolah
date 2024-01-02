<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangSModel extends Model
{
    protected $table            = 'barang_status';
    protected $primaryKey       = 'id_barang_status';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang_status','id_barang','tgl_rusak','tgl_baik','keterangan','status','stok','stok_baik'];

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

    public function getBarangStatus()
    {
        return $this->findAll();
    }

    public function getbarang2(){
        return $this->db->table('barang_status')->join('barang','barang.id=barang_status.id_barang')
        ->get()->getResultArray();
    }

    public function getbarangbaik(){
        return $this->db->table('barang_status')->join('barang','barang.id=barang_status.id_barang')->where('status','2')
        ->get()->getResultArray();
    }
}

