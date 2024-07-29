<?php

namespace App\Models;

use CodeIgniter\Model;

class BimbinganKonselingModel extends Model
{
    protected $table            = 'bimbingan_konseling';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_siswa', 'tanggal', 'catatan'];


    public function getData()
    {
        if (session()->get('level') == "Siswa") {
            return $this->join('siswa', 'siswa.id=bimbingan_konseling.id_siswa')
                ->select('siswa.nama,siswa.nis,bimbingan_konseling.*')->where('siswa.id', session()->get('id_siswa'))->findAll();
        } else {
            return $this->join('siswa', 'siswa.id=bimbingan_konseling.id_siswa')
                ->select('siswa.nama,siswa.nis,bimbingan_konseling.*')->findAll();
        }
    }
}
