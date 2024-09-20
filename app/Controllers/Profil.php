<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Profil extends BaseController
{
    public function index()
    {
        $data = "Profil";
        $hover = "Profil";
        $page = "profil";
        $id_user = session()->get('id');
        $pegawai = new PegawaiModel();
        $dt = $pegawai->where([
            'user_id' => $id_user,
        ])->first();
        $d_pegawai = $pegawai->where([
            'id' => session()->get('id_pegawai')
        ])->first();
        return view('main/profil', compact('data', 'd_pegawai', 'hover', 'page'));
    }
}
