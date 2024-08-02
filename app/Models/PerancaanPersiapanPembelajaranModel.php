<?php

namespace App\Models;

use CodeIgniter\Model;

class PerancaanPersiapanPembelajaranModel extends Model
{
    protected $table            = 'perencanaan_persiapan_pembelajaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'id_guru', 'id_mapel', 'materi', 'tanggal', 'id_media', 'tujuan', 'id_user_verifikasi'];


    public function getData()
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')->findAll();
    }

    public function cetakDataBeetwen($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')
            ->where("perencanaan_persiapan_pembelajaran.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')
            ->findAll();
    }

    public function cetakDataBeetwenGuru($dari, $sampai)
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')
            ->where("perencanaan_persiapan_pembelajaran.tanggal BETWEEN '$dari' AND '$sampai'")
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')
            ->where('guru.id', session()->get('id_guru'))
            ->findAll();
    }

    public function cetakDataPerguru()
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')
            ->where('guru.id', session()->get('id_guru'))->findAll();
    }
    public function cetakData()
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')->findAll();
    }

    public function getDataPerguru()
    {
        return $this->join('guru', 'guru.id=perencanaan_persiapan_pembelajaran.id_guru')
            ->join('users', 'users.id=guru.user_id')
            ->join('mapel', 'mapel.id=perencanaan_persiapan_pembelajaran.id_mapel')
            ->join('media', 'media.id=perencanaan_persiapan_pembelajaran.id_media')
            ->select('guru.nama,guru.nip,perencanaan_persiapan_pembelajaran.*,users.level,mapel.nama_mapel,media.media')
            ->where('guru.id', session()->get('id_guru'))->findAll();
    }

    public function getChart()
    {
        return $this->where('id_guru', session()->get('id_guru'))
            ->groupStart()
            ->where('id_user_verifikasi >', 0)
            ->where('id_user_verifikasi IS NOT NULL')
            ->groupEnd()
            ->findAll();
    }
}
