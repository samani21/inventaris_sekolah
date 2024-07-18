<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = "Dashboard";
        $hover = "Dashboard";
        $page = "dashboard";
        $id_user = session()->get('id');
        $guru = new GuruModel();
        $dt = $guru->where([
            'user_id' => $id_user,
        ])->first();
        return view('dashboard/index', compact('data', 'hover', 'page'));
    }
}
