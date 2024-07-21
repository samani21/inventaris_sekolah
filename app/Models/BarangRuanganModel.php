<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangRuanganModel extends Model
{
    protected $table            = 'barang_peruangan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'id_guru', 'id_barang_masuk', 'tgl_pinjam', 'tgl_selesai', 'ruangan', 'status_r', 'stok', 'stok_selesai'];


    public function getData()
    {
        return $this->join('guru', 'guru.id =barang_peruangan.id_guru ')
            ->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_peruangan.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->select('barang.nama_barang,barang.kode_barang,barang_masuk.status,barang_peruangan.id,barang_peruangan.tgl_pinjam as tanggal_pinjam,barang_peruangan.tgl_selesai as tanggal_selesai,barang_peruangan.stok,barang_peruangan.stok_selesai,barang_peruangan.ruangan,barang_peruangan.status_r as status_pinjam')->findAll();
    }
    public function getDataBeetwen($dari, $sampai)
    {
        return $this->join('guru', 'guru.id =barang_peruangan.id_guru ')
            ->join('barang_masuk', 'barang_masuk.id_barang_masuk=barang_peruangan.id_barang_masuk')
            ->join('barang', 'barang.id=barang_masuk.id_barang')
            ->select('barang.nama_barang,barang.kode_barang,barang_masuk.status,barang_peruangan.id,barang_peruangan.tgl_pinjam as tanggal_pinjam,barang_peruangan.tgl_selesai as tanggal_selesai,barang_peruangan.stok,barang_peruangan.stok_selesai,barang_peruangan.ruangan,barang_peruangan.status_r as status_pinjam')
            ->where("tgl_pinjam BETWEEN '$dari' AND '$sampai'")
            ->orWhere("tgl_selesai BETWEEN '$dari' AND '$sampai'")
            ->findAll();
    }

    public function getPeruangan($ruangan)
    {
        if (session()->get('level') == "Admin") {
            return $this->db->table('barang_peruangan')->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang', 'barang.id = barang_masuk.id_barang')->join('guru', 'guru.id = barang_peruangan.id_guru')->where('ruangan', $ruangan)
                ->get()->getResultArray();
        } else {
            $id_guru = session()->get('id_guru');

            return $this->db->table('barang_peruangan')->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang', 'barang.id = barang_masuk.id_barang')->join('guru', 'guru.id = barang_peruangan.id_guru')->where('ruangan', $ruangan)
                ->get()->getResultArray();
        }
    }

    public function getPakai($ruangan)
    {
        return $this->db->table('barang_peruangan')->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_peruangan.id_barang_masuk')->join('barang', 'barang.id = barang_masuk.id_barang')->join('guru', 'guru.id = barang_peruangan.id_guru')->where('ruangan', $ruangan)
            ->get()->getResultArray();
    }
    public function getSelesai()
    {
        if (session()->get('level') == "Admin") {
            return $this->db->table('barang_peruangan')->join('barang', 'barang.id=barang_peruangan.id_barang')->join('guru', 'guru.id = barang_peruangan.id_guru')->where('status', 2)
                ->get()->getResultArray();
        } else {
            $id_guru = session()->get('id_guru');
            return $this->db->table('barang_peruangan')->join('barang', 'barang.id=barang_peruangan.id_barang')->join('guru', 'guru.id = barang_peruangan.id_guru')->where('status', 2)
                ->get()->getResultArray();
        }
    }
}
