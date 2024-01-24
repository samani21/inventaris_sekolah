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
    protected $allowedFields    = ['id_barang_peruangan','id_guru','id_barang_masuk','tgl_pinjam','tgl_selesai','ruangan','status_r','stok','stok_selesai'];

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

    public function getPeruangan($ruangan){
        if(session()->get('level') == "Admin"){
            return $this->db->table('barang_peruangan')->join('barang_masuk','barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang','barang.id = barang_masuk.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('ruangan',$ruangan)
            ->get()->getResultArray();
        }else{
            $id_guru = session()->get('id_guru');
        
            return $this->db->table('barang_peruangan')->join('barang_masuk','barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang','barang.id = barang_masuk.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('ruangan',$ruangan)
            ->get()->getResultArray();
        }
    }

    public function getPakai($ruangan){
        if(session()->get('level') == "Admin"){
            return $this->db->table('barang_peruangan')->join('barang_masuk','barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang','barang.id = barang_masuk.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('ruangan',$ruangan)
            ->get()->getResultArray();
        }else{
            $id_guru = session()->get('id_guru');
            return $this->db->table('barang_peruangan')->join('barang_masuk','barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang','barang.id = barang_masuk.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')
            ->get()->getResultArray();
        }
    }
    public function getSelesai(){
        if(session()->get('level') == "Admin"){
            return $this->db->table('barang_peruangan')->join('barang','barang.id=barang_peruangan.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('status',2)
            ->get()->getResultArray();
        }else{
            $id_guru = session()->get('id_guru');
            return $this->db->table('barang_peruangan')->join('barang','barang.id=barang_peruangan.id_barang')->join('guru','guru.id = barang_peruangan.id_guru')->where('status',2)
            ->get()->getResultArray();
        }
    }
}
