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
            ->join('siswa_perkelas', 'siswa_perkelas.id = absen_siswa.id_siswa_perkelas')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('nilai', 'nilai.id_absen_siswa=absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa=absen_siswa.id', 'left')
            ->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('protofolio_proyek', 'protofolio_proyek.id_absen_siswa=absen_siswa.id', 'left')
            ->where([
                'id_guru' => session()->get('id_guru'),
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])
            ->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL OR protofolio_proyek.nilai IS NOT NULL)')
            ->select('COALESCE(nilai.nilai,nilai_ujian.nilai,protofolio_proyek.nilai) as nilai,
        COALESCE(nilai.jenis,nilai_ujian.jenis,"Proyek") as jenis,
        COALESCE(nilai.tanggal,
        nilai_ujian.tanggal,protofolio_proyek.tanggal) as tanggal,
        siswa.nis,siswa.nama,
        nama_mapel,
        tahun,
        semester,
        nilai.materi,
        kelas.nama_kelas as kelas')->findAll();
    }
    public function reportNilai($tahun_ajaran)
    {
        return $this->join('tahun_ajaran', 'tahun_ajaran.id = absen_siswa.id_tahun_ajaran')
            ->join('mapel', 'mapel.id = absen_siswa.id_mapel')
            ->join('siswa_perkelas', 'siswa_perkelas.id = absen_siswa.id_siswa_perkelas')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('nilai', 'nilai.id_absen_siswa=absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa=absen_siswa.id', 'left')
            ->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('protofolio_proyek', 'protofolio_proyek.id_absen_siswa=absen_siswa.id', 'left')
            ->where([
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])
            ->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL OR protofolio_proyek.nilai IS NOT NULL)')
            ->select('COALESCE(nilai.nilai,nilai_ujian.nilai,protofolio_proyek.nilai) as nilai,
        COALESCE(nilai.jenis,nilai_ujian.jenis,"Proyek") as jenis,
        COALESCE(nilai.tanggal,
        nilai_ujian.tanggal,protofolio_proyek.tanggal) as tanggal,
            siswa.nis,siswa.nama,
            nama_mapel,
            tahun,
            semester,
            nilai.materi,
            kelas.nama_kelas as kelas')->findAll();
    }

    public function reportGuruBetween($tahun_ajaran, $dari, $sampai)
    {
        return $this->join('tahun_ajaran', 'tahun_ajaran.id = absen_siswa.id_tahun_ajaran')
            ->join('mapel', 'mapel.id = absen_siswa.id_mapel')
            ->join('nilai', 'nilai.id_absen_siswa = absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa = absen_siswa.id', 'left')
            ->join('siswa_perkelas', 'siswa_perkelas.id = absen_siswa.id_siswa_perkelas')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('siswa', 'siswa.id = siswa_perkelas.id_siswa')
            ->join('protofolio_proyek', 'protofolio_proyek.id_absen_siswa = absen_siswa.id', 'left')
            ->where([
                'absen_siswa.id_guru' => session()->get('id_guru'),
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])
            ->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL OR protofolio_proyek.nilai IS NOT NULL)')
            ->where("(
                nilai.tanggal BETWEEN '$dari' AND '$sampai' OR 
                nilai_ujian.tanggal BETWEEN '$dari' AND '$sampai' OR 
                protofolio_proyek.tanggal BETWEEN '$dari' AND '$sampai'
            )")
            ->select('
                COALESCE(nilai.nilai, nilai_ujian.nilai, protofolio_proyek.nilai) as nilai,
                COALESCE(nilai.jenis, nilai_ujian.jenis, "Proyek") as jenis,
                COALESCE(nilai.tanggal, nilai_ujian.tanggal, protofolio_proyek.tanggal) as tanggal,
                mapel.nama_mapel as nama_mapel,
                siswa.nis,
                siswa.nama,
                tahun_ajaran.tahun,
                tahun_ajaran.semester,
                nilai.materi,
                kelas.nama_kelas as kelas
            ')
            ->findAll();
    }

    public function reportNilaiBetween($tahun_ajaran, $dari, $sampai)
    {
        return $this->join('tahun_ajaran', 'tahun_ajaran.id = absen_siswa.id_tahun_ajaran')
            ->join('mapel', 'mapel.id = absen_siswa.id_mapel')
            ->join('nilai', 'nilai.id_absen_siswa=absen_siswa.id', 'left')
            ->join('nilai_ujian', 'nilai_ujian.id_absen_siswa=absen_siswa.id', 'left')
            ->join('siswa_perkelas', 'siswa_perkelas.id = absen_siswa.id_siswa_perkelas')
            ->join('kelas', 'kelas.id = siswa_perkelas.id_kelas')
            ->join('siswa', 'siswa.id=siswa_perkelas.id_siswa')
            ->join('protofolio_proyek', 'protofolio_proyek.id_absen_siswa=absen_siswa.id', 'left')
            ->where([
                'tahun_ajaran.tahun' => $tahun_ajaran,
            ])
            ->where('(nilai_ujian.nilai IS NOT NULL OR nilai.nilai IS NOT NULL OR protofolio_proyek.nilai IS NOT NULL)')
            ->where("(
                nilai.tanggal BETWEEN '$dari' AND '$sampai' OR 
                nilai_ujian.tanggal BETWEEN '$dari' AND '$sampai' OR 
                protofolio_proyek.tanggal BETWEEN '$dari' AND '$sampai'
            )")
            ->select('COALESCE(nilai.nilai,nilai_ujian.nilai,protofolio_proyek.nilai) as nilai,
        COALESCE(nilai.jenis,nilai_ujian.jenis,"Proyek") as jenis,
        COALESCE(nilai.tanggal,
        nilai_ujian.tanggal,protofolio_proyek.tanggal) as tanggal,
        siswa.nis,siswa.nama,
            nama_mapel,
            tahun,
            semester,
            nilai.materi,
            kelas.nama_kelas as kelas')->findAll();
    }
    public function cetakRaport($id_siswa_perkelas)
    {
        return $this
            ->select('
                AVG(nilai.nilai) AS nilai_harian,
                SUM(CASE WHEN nilai_ujian.jenis = \'PTS\' THEN nilai_ujian.nilai ELSE 0 END) AS pts,
                SUM(CASE WHEN nilai_ujian.jenis = \'PAS\' THEN nilai_ujian.nilai ELSE 0 END) AS pas,
                mapel.nama_mapel as mapel
            ')
            ->join('nilai', 'nilai.id_absen_siswa = absen_siswa.id', 'left')
            ->join('nilai_ujian', 'absen_siswa.id = nilai_ujian.id_absen_siswa', 'left')
            ->join('mapel', 'mapel.id=absen_siswa.id_mapel')
            ->where('absen_siswa.id_siswa_perkelas', $id_siswa_perkelas)
            ->groupStart()
            ->where('nilai.nilai IS NOT NULL')
            ->orWhere('nilai_ujian.nilai IS NOT NULL')
            ->groupEnd()
            ->groupBy('absen_siswa.id_mapel')
            ->findAll();
    }
}
