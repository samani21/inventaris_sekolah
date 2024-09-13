<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

    public function __construct() {}

    public function index()
    {
        $data = "Dashboard";
        $hover = "Dashboard";
        $page = "dashboard";
        return view('dashboard/index', compact('data', 'hover', 'page'));
    }
}
