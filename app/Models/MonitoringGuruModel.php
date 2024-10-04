<?php

namespace App\Models;

use CodeIgniter\Model;

class MonitoringGuruModel extends Model
{
    protected $table = 'monitoring_guru';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_guru', 'tanggal', 'status_kinerja', 'catatan'];



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
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')->findAll();
    }
    public function getDiagram()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT DISTINCT(status_kinerja) as status_kinerja,COUNT(status_kinerja)as total FROM `monitoring_guru` WHERE id_guru =" . session()->get('id_guru') . " GROUP BY status_kinerja;");

        return $query->getResultArray();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')->where('guru.id', session()->get('id_guru'))->findAll();
    }

    public function cetakDataBeetwen($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')
            ->where("monitoring_guru.tanggal BETWEEN '$dari' AND '$sampai'")
            ->findAll();
    }

    public function cetakDataBeetwenGuru($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')
            ->where("monitoring_guru.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('guru.id', session()->get('id_guru'))
            ->findAll();
    }

    public function cetakDataPerguru()
    {
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')
            ->where('guru.id', session()->get('id_guru'))->findAll();
    }
    public function cetakData()
    {
        return $this->join('guru', 'guru.id=monitoring_guru.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->select('guru.nama,guru.nip,monitoring_guru.*,users.level')->findAll();
    }
}
