<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_absen_siswa', 'tanggal', 'nilai', 'id_tahun_ajaran','jenis','materi'];
}
