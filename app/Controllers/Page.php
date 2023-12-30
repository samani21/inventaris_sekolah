<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Page extends BaseController
{
    public function about1()
	{
		return view('about');
	}
    
    public function contact()
	{
		return view('contact');
	}
}
