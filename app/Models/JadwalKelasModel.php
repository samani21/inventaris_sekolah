<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKelasModel extends Model
{
    protected $table = 'jadwal_kelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'hari', 'jam', 'id_kelas', 'id_mapel', 'id_guru', 'id_tahun_ajaran'];

    public function getData($tahunajaran)
    {
        return $this->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
            ->join('guru', 'guru.id=jadwal_kelas.id_guru')
            ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')
            ->join('tahun_ajaran', 'tahun_ajaran.id=jadwal_kelas.id_tahun_ajaran')
            ->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel,guru.nama as nama_guru')
            ->where('tahun_ajaran.tahun', $tahunajaran)
            ->findAll();
    }

    public function getDataPerguru($id_guru, $tahunajaran)
    {
        return $this->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
            ->join('guru', 'guru.id=jadwal_kelas.id_guru')
            ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')
            ->join('tahun_ajaran', 'tahun_ajaran.id=jadwal_kelas.id_tahun_ajaran')
            ->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel,guru.nama as nama_guru')
            ->where('id_guru', $id_guru)
            ->where('tahun_ajaran.tahun', $tahunajaran)
            ->findAll();
    }
    public function getDataPersiswa($id_siswa, $tahunajaran)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('siswa_perkelas');
        $builder->where('id_siswa', $id_siswa);
        $query = $builder->get()->getRowArray();

        if ($query) {
            return $this->join('kelas', 'kelas.id=jadwal_kelas.id_kelas')
                ->join('guru', 'guru.id=jadwal_kelas.id_guru')
                ->join('mapel', 'mapel.id=jadwal_kelas.id_mapel')
                ->join('tahun_ajaran', 'tahun_ajaran.id=jadwal_kelas.id_tahun_ajaran')
                ->select('kelas.nama_kelas,jadwal_kelas.*,mapel.nama_mapel,guru.nama as nama_guru')
                ->where('id_kelas', $query['id_kelas'])
                ->where('tahun_ajaran.tahun', $tahunajaran)
                ->findAll();
        } else {
            return [];
        }
    }


    public function getEnumValues($field)
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
