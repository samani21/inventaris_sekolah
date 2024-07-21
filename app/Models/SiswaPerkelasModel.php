<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaPerkelasModel extends Model
{
    protected $table = 'siswa_perkelas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa', 'id_kelas', 'id_tahun_ajaran'];

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
}
