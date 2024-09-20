<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IzinParkirModel;
use App\Models\RetribusiParkirModel;

class Dashboard extends BaseController
{

    public function __construct() {}

    public function index()
    {
        $data = "Dashboard";
        $hover = "Dashboard";
        $page = "dashboard";
        $db = \Config\Database::connect();

        // Ambil data pengaduan per bulan
        $pengaduan = $db->query("SELECT MONTH(tanggal_pengaduan) AS bulan, COUNT(id) AS jumlah_pengaduan 
                             FROM pengaduan 
                             GROUP BY bulan ORDER BY bulan asc")->getResultArray();

        // Ambil data izin parkir per bulan
        $izinParkir = $db->query("SELECT MONTH(tanggal_mulai) AS bulan, COUNT(id) AS jumlah_izin 
                              FROM izin_parkir 
                              GROUP BY bulan ORDER BY bulan asc")->getResultArray();

        // Kirim data ke view
        return view('dashboard/index', [
            'pengaduan' => json_encode($pengaduan),
            'izinParkir' => json_encode($izinParkir),
            'data' => $data,
            'hover' => $hover,
            'page' => $page
        ]);
    }
}
