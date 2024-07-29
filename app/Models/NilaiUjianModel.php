<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiUjianModel extends Model
{
    protected $table = 'nilai_ujian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_absen_siswa', 'tanggal', 'nilai', 'id_tahun_ajaran','jenis'];
}
