<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profil extends BaseController
{
    public function index()
    {
        $data = "Profil";
        $hover = "Profil";
        $page = "profil";
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $dt = $guru->where([
            'user_id' => $id_user,
        ])->first();
        if (empty($dt)) {
            return view('tata_usaha/tambah', compact('id_user'));
        } else {
            if (session()->get('level') == "Siswa") {
                $model = new SiswaModel();
                $d_siswa = $model->where([
                    'id' => session()->get('id_siswa')
                ])->first();
                return view('main/profil', compact('data', 'd_siswa', 'hover', 'page'));
            } else {
                $d_guru = $guru->where([
                    'id' => session()->get('id_guru')
                ])->first();
                return view('main/profil', compact('data', 'd_guru', 'hover', 'page'));
            }
        }
    }
}
