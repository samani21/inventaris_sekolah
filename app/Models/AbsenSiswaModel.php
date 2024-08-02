<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenSiswaModel extends Model
{
    protected $table = 'absen_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa_perkelas', 'id_tahun_ajaran', 'tanggal', 'hadir', 'id_mapel', 'id_guru'];

    public function reportGuru($tahun_ajaran)
    {
        return $this->join('tahun_ajaran', 'tahun_ajaran.id = absen_siswa.id_tahun_ajaran')
            ->join('mapel', 'mapel.id = absen_siswa.id_mapel')
            ->join('nilai', 'nilai.id_absen_siswa=absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa=absen_siswa.id', 'left')
            ->where([
                'id_guru' => session()->get('id_guru'),
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL)')
            ->select('COALESCE(nilai.nilai,nilai_ujian.nilai) as nilai,
            COALESCE(nilai.jenis,nilai_ujian.jenis) as jenis,
            COALESCE(nilai.tanggal,
            nilai_ujian.tanggal) as tanggal,
            nama_mapel,
            tahun,
            semester,
            nilai.materi')->findAll();
    }

    public function reportGuruBetween($tahun_ajaran, $dari, $sampai)
    {
        return $this->join('tahun_ajaran', 'tahun_ajaran.id = absen_siswa.id_tahun_ajaran')
            ->join('mapel', 'mapel.id = absen_siswa.id_mapel')
            ->join('nilai', 'nilai.id_absen_siswa=absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa=absen_siswa.id', 'left')
            ->where([
                'id_guru' => session()->get('id_guru'),
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL)')
            ->where("nilai.tanggal BETWEEN '$dari' AND '$sampai' OR nilai_ujian.tanggal BETWEEN '$dari' AND '$sampai'")
            ->select('COALESCE(nilai.nilai,nilai_ujian.nilai) as nilai,
            COALESCE(nilai.jenis,nilai_ujian.jenis) as jenis,
            COALESCE(nilai.tanggal,
            nilai_ujian.tanggal) as tanggal,
            nama_mapel,
            tahun,
            semester,
            nilai.materi')->findAll();
    }
}
