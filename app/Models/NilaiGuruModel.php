<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiGuruModel extends Model
{
    protected $table = 'nilai_guru';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_guru', 'id_tahun_ajaran', 'tanggal', 'nilai', 'kategori', 'keterangan'];



    public function getEnumKategori($field)
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

    public function getData()
    {
        return $this->join('guru', 'guru.id=nilai_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id=nilai_guru.id_tahun_ajaran')
            ->select('guru.nama,guru.nip,nilai_guru.*,users.level,tahun,semester')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=nilai_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('tahun_ajaran', 'tahun_ajaran.id=nilai_guru.id_tahun_ajaran')
            ->select('guru.nama,guru.nip,nilai_guru.*,users.level,tahun,semester')->where('guru.id', session()->get('id_guru'))->findAll();
    }
}
