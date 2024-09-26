<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaPerkelasModel extends Model
{
    protected $table = 'siswa_perkelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'id_kelas', 'id_tahun_ajaran'];

    public function getDataKelas($kelas, $tahunajaran)
    {
        return $this->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id=siswa_perkelas.id_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.id=siswa_perkelas.id_tahun_ajaran')
            ->where([
                'nama_kelas' => $kelas,
                'tahun_ajaran.tahun' => $tahunajaran
            ])
            ->select('siswa.nis,siswa.nama,siswa.jenis_kelamin,kelas.nama_kelas as kelas,siswa_perkelas.*')
            ->findAll();
    }

    public function getData($kelas, $tanggal, $mapel, $tahunajaran)
    {
        return $this->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id=siswa_perkelas.id_kelas')
            ->join('absen_siswa', 'absen_siswa.id_siswa_perkelas=siswa_perkelas.id', 'left')
            ->join('mapel', 'mapel.id=absen_siswa.id_mapel', 'left')
            ->join('tahun_ajaran', 'tahun_ajaran.id=siswa_perkelas.id_tahun_ajaran')
            ->select('siswa_perkelas.*, 
                                siswa.nama AS nama, 
                                siswa.nis AS nis, 
                                siswa.jenis_kelamin AS jenis_kelamin, 
                                kelas.nama_kelas AS kelas, 
                                COUNT(absen_siswa.id) AS jumlah_absen, 
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '", mapel.nama_mapel, NULL) SEPARATOR ", ") AS nama_mapel,
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '" AND absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.id, NULL) SEPARATOR ", ") AS id_absen_siswa,
                                GROUP_CONCAT(DISTINCT IF(absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.tanggal, NULL) SEPARATOR ", ") AS tanggal,
                                GROUP_CONCAT(DISTINCT IF(absen_siswa.hadir = 1, absen_siswa.hadir, NULL) SEPARATOR ", ") AS hadir,
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '" AND absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.status, NULL) SEPARATOR ", ") AS status,
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '" AND absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.id, NULL) SEPARATOR ", ") AS id_absen')
            ->where([
                'kelas.nama_kelas' => $kelas,
                'tahun_ajaran.tahun' => $tahunajaran
            ])->groupBy('siswa_perkelas.id, siswa.nama, kelas.nama_kelas')->findAll();
    }

    public function getDataTanggalMapel($kelas, $tanggal, $mapel)
    {
        return $this->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id=siswa_perkelas.id_kelas')
            ->join('absen_siswa', 'siswa_perkelas.id = absen_siswa.id_siswa_perkelas', 'left')
            ->join('mapel', 'mapel.id=absen_siswa.id_mapel')
            ->select('siswa_perkelas.id,siswa.nis,siswa.nama,siswa.jenis_kelamin,kelas.nama_kelas as kelas,absen_siswa.hadir')
            ->where([
                'kelas.nama_kelas' => $kelas,
                'absen_siswa.tanggal' => $tanggal,
                'mapel.nama_mapel' => $mapel,
            ])->findAll();
    }
    public function getList($id)
    {
        return $this->where('id', $id)->first();
    }

    public function getDataPersiswa($kelas, $tanggal, $mapel, $tahunajaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT 
            siswa.id AS siswa_id, 
            siswa.nama, 
            mapel.id AS mapel_id, 
            AVG(nilai.nilai) AS nilai, 
            AVG(nilai_ujian.nilai) AS nilai_ujian, 
            AVG(COALESCE(nilai.nilai, 0) + COALESCE(nilai_ujian.nilai, 0)) AS total_rata_rata_nilai, 
            mapel.nama_mapel as mapel, 
            kelas.nama_kelas as kelas,
            tahun_ajaran.tahun,
            tahun_ajaran.semester
        FROM 
            siswa_perkelas 
        JOIN 
            siswa ON siswa.id = siswa_perkelas.id_siswa 
        JOIN 
            absen_siswa ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
        LEFT JOIN 
            nilai ON absen_siswa.id = nilai.id_absen_siswa 
        LEFT JOIN 
            nilai_ujian ON absen_siswa.id = nilai_ujian.id_absen_siswa 
        JOIN 
            mapel ON absen_siswa.id_mapel = mapel.id 
        JOIN 
            kelas ON siswa_perkelas.id_kelas = kelas.id 
        JOIN 
            tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran
        WHERE 
            kelas.nama_kelas = '" . $kelas . "' AND siswa.id = '" . session()->get('id_siswa') . "'
        GROUP BY 
            siswa.id, 
            siswa.nama, 
            mapel.id, 
            mapel.nama_mapel, 
            kelas.id, 
            kelas.nama_kelas,
            tahun_ajaran.tahun,
            tahun_ajaran.semester
        ORDER BY 
            siswa.id");

        return $query->getResultArray();
    }

    public function getDataPersiswaHarian($kelas, $tanggal, $mapel, $tahunajaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT 
                siswa.nama,
                kelas.nama_kelas AS kelas,
                mapel.nama_mapel AS mapel,
                COALESCE(nilai.nilai, protofolio_proyek.nilai) AS nilai,
                COALESCE(nilai.materi, protofolio_proyek.deskripsi) AS materi,
                tahun_ajaran.tahun,
                tahun_ajaran.semester,
                COALESCE(nilai.jenis, 'Protofolio dan Proyek') AS jenis,
                COALESCE(nilai.tanggal, protofolio_proyek.tanggal) AS tanggal
            FROM absen_siswa
            JOIN siswa_perkelas ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas
            JOIN siswa ON siswa.id = siswa_perkelas.id_siswa
            JOIN mapel ON mapel.id = absen_siswa.id_mapel
            JOIN kelas ON kelas.id = siswa_perkelas.id_kelas
            JOIN tahun_ajaran ON tahun_ajaran.id = absen_siswa.id_tahun_ajaran
            LEFT JOIN nilai ON nilai.id_absen_siswa = absen_siswa.id
            LEFT JOIN protofolio_proyek ON protofolio_proyek.id_absen_siswa = absen_siswa.id
            WHERE kelas.nama_kelas = ? 
            AND siswa.id = ? 
            AND (nilai.id IS NOT NULL OR protofolio_proyek.id IS NOT NULL)
        ", [$kelas, session()->get('id_siswa')]);

        //     $query = $db->query("SELECT 
        //     siswa.id AS siswa_id, 
        //     siswa.nama, 
        //     mapel.id AS mapel_id, 
        //     nilai.nilai AS nilai,   
        //     mapel.nama_mapel as mapel, 
        //     kelas.nama_kelas as kelas,
        //     tahun_ajaran.tahun,
        //     tahun_ajaran.semester
        // FROM 
        //     siswa_perkelas 
        // JOIN 
        //     siswa ON siswa.id = siswa_perkelas.id_siswa 
        // JOIN 
        //     absen_siswa ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
        // LEFT JOIN 
        //     nilai ON absen_siswa.id = nilai.id_absen_siswa 
        // LEFT JOIN 
        //     nilai_ujian ON absen_siswa.id = nilai_ujian.id_absen_siswa 
        // JOIN 
        //     mapel ON absen_siswa.id_mapel = mapel.id 
        // JOIN 
        //     kelas ON siswa_perkelas.id_kelas = kelas.id 
        // JOIN 
        //     tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran
        // WHERE 
        //     kelas.nama_kelas = '" . $kelas . "' AND siswa.id = '" . session()->get('id_siswa') . "'");


        return $query->getResultArray();
    }

    public function getDataPersiswaUjian($kelas, $tanggal, $mapel, $tahunajaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT siswa.nama,kelas.nama_kelas as kelas,mapel.nama_mapel as mapel,nilai_ujian.nilai as nilai_ujian,tahun_ajaran.tahun,tahun_ajaran.semester,jenis,nilai_ujian.tanggal 
        FROM `nilai_ujian` 
        JOIN absen_siswa ON absen_siswa.id = nilai_ujian.id_absen_siswa 
        JOIN mapel ON mapel.id = absen_siswa.id_mapel 
        JOIN siswa_perkelas ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
        JOIN siswa ON siswa_perkelas.id_siswa = siswa.id 
        JOIN tahun_ajaran ON tahun_ajaran.id = nilai_ujian.id_tahun_ajaran
        JOIN kelas ON siswa_perkelas.id_kelas = kelas.id
        WHERE 
            kelas.nama_kelas = '" . $kelas . "' AND siswa.id = '" . session()->get('id_siswa') . "'");

        //     $query = $db->query("SELECT 
        //     siswa.id AS siswa_id, 
        //     siswa.nama, 
        //     mapel.id AS mapel_id, 
        //     nilai.nilai AS nilai,   
        //     mapel.nama_mapel as mapel, 
        //     kelas.nama_kelas as kelas,
        //     tahun_ajaran.tahun,
        //     tahun_ajaran.semester
        // FROM 
        //     siswa_perkelas 
        // JOIN 
        //     siswa ON siswa.id = siswa_perkelas.id_siswa 
        // JOIN 
        //     absen_siswa ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
        // LEFT JOIN 
        //     nilai ON absen_siswa.id = nilai.id_absen_siswa 
        // LEFT JOIN 
        //     nilai_ujian ON absen_siswa.id = nilai_ujian.id_absen_siswa 
        // JOIN 
        //     mapel ON absen_siswa.id_mapel = mapel.id 
        // JOIN 
        //     kelas ON siswa_perkelas.id_kelas = kelas.id 
        // JOIN 
        //     tahun_ajaran ON tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran
        // WHERE 
        //     kelas.nama_kelas = '" . $kelas . "' AND siswa.id = '" . session()->get('id_siswa') . "'");


        return $query->getResultArray();
    }

    public function reportSiswa()
    {
        return $this->join('siswa', 'siswa.id = siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran')
            ->select('nis,siswa.nama,kelas.nama_kelas as kelas,tahun,semester,siswa_perkelas.id')
            ->orderBy('kelas.nama_kelas,siswa.nis', 'asc')
            ->orderBy('tahun_ajaran.semester,tahun_ajaran.tahun', 'desc')->findAll();
    }

    public function reportPersiswa()
    {
        return $this->join('siswa', 'siswa.id = siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.id = siswa_perkelas.id_tahun_ajaran')
            ->select('nis,siswa.nama,kelas.nama_kelas as kelas,tahun,semester,siswa_perkelas.id')
            ->where('siswa.id', session()->get('id_siswa'))
            ->orderBy('kelas.nama_kelas,siswa.nis', 'asc')
            ->orderBy('tahun_ajaran.semester,tahun_ajaran.tahun', 'desc')->findAll();
    }
}
