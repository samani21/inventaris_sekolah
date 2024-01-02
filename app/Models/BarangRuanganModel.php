<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangRuanganModel extends Model
{
    protected $table            = 'barang_peruangan';
    protected $primaryKey       = 'id_barang_peruangan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_barang_peruangan','id_guru','id_barang','tgl_pinjam','tgl_selesai','ruangan','status','stok','stok_selesai'];

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

    public function getBarangruangan()
    {
        return $this->findAll();
    }

    public function getPeruangan(){
        $id_guru = session()->get('id_guru');
        
        return $this->db->table('barang_peruangan')->join('barang','barang.id=barang_peruangan.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('id_guru',$id_guru)
        ->get()->getResultArray();
    }
}
