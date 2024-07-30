<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaPerkelasModel extends Model
{
    protected $table = 'siswa_perkelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'id_kelas', 'id_tahun_ajaran'];

    public function getDataKelas($kelas, $idTahunAjaran)
    {
        return $this->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id=siswa_perkelas.id_kelas')
            ->where([
                'nama_kelas' => $kelas,
                'id_tahun_ajaran' => $idTahunAjaran
            ])
            ->select('siswa.nis,siswa.nama,siswa.jenis_kelamin,kelas.nama_kelas as kelas,siswa_perkelas.*')
            ->findAll();
    }

    public function getData($kelas, $tanggal, $mapel, $idTahunAjaran)
    {
        return $this->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('kelas', 'kelas.id=siswa_perkelas.id_kelas')
            ->join('absen_siswa', 'absen_siswa.id_siswa_perkelas=siswa_perkelas.id', 'left')
            ->join('mapel', 'mapel.id=absen_siswa.id_mapel', 'left')
            ->select('siswa_perkelas.*, 
                                siswa.nama AS nama, 
                                siswa.nis AS nis, 
                                siswa.jenis_kelamin AS jenis_kelamin, 
                                kelas.nama_kelas AS kelas, 
                                COUNT(absen_siswa.id) AS jumlah_absen, 
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '", mapel.nama_mapel, NULL) SEPARATOR ", ") AS nama_mapel,
                                GROUP_CONCAT(DISTINCT IF(mapel.nama_mapel = "' . $mapel . '" AND absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.id, NULL) SEPARATOR ", ") AS id_absen_siswa,
                                GROUP_CONCAT(DISTINCT IF(absen_siswa.tanggal = "' . $tanggal . '", absen_siswa.tanggal, NULL) SEPARATOR ", ") AS tanggal,
                                GROUP_CONCAT(DISTINCT IF(absen_siswa.hadir = 1, absen_siswa.hadir, NULL) SEPARATOR ", ") AS hadir')
            ->where([
                'kelas.nama_kelas' => $kelas,
                'siswa_perkelas.id_tahun_ajaran' => $idTahunAjaran
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

    public function getDataPersiswa($kelas, $tanggal, $mapel, $idTahunAjaran)
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

    public function getDataPersiswaHarian($kelas, $tanggal, $mapel, $idTahunAjaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT siswa.nama,kelas.nama_kelas as kelas,mapel.nama_mapel as mapel,nilai.nilai,tahun_ajaran.tahun,tahun_ajaran.semester,materi,jenis,nilai.tanggal 
        FROM `nilai` 
        JOIN absen_siswa ON absen_siswa.id = nilai.id_absen_siswa 
        JOIN mapel ON mapel.id = absen_siswa.id_mapel 
        JOIN siswa_perkelas ON siswa_perkelas.id = absen_siswa.id_siswa_perkelas 
        JOIN siswa ON siswa_perkelas.id_siswa = siswa.id 
        JOIN tahun_ajaran ON tahun_ajaran.id = nilai.id_tahun_ajaran
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

    public function getDataPersiswaUjian($kelas, $tanggal, $mapel, $idTahunAjaran)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT siswa.nama,kelas.nama_kelas as kelas,mapel.nama_mapel as mapel,nilai_ujian.nilai,tahun_ajaran.tahun,tahun_ajaran.semester,jenis,nilai_ujian.tanggal 
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
}
