<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenSiswaModel extends Model
{
    protected $table = 'absen_siswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_siswa_perkelas', 'id_tahun_ajaran', 'tanggal', 'hadir', 'id_mapel', 'id_guru'];
}
