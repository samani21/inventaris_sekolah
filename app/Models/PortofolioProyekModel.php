<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofolioProyekModel extends Model
{
    protected $table = 'protofolio_proyek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_absen_siswa', 'deskripsi', 'tanggal', 'nilai','id_tahun_ajaran'];
}
