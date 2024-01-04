<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = "Profil";
        $hover = "Profil";
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $dt = $guru->where([
            'user_id'=>$id_user,
        ])->first();
        if(empty($dt)){
            return view('guru/tambah',compact('id_user'));
        }else{
            $d_guru = $guru->where([
                'id' => session()->get('id_guru')
            ])->first();
            return view('guru/profil',compact('data','d_guru','hover'));
        }
    }
}
