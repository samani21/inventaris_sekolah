<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Page extends BaseController
{
    public function about1()
	{
		$data = "About";
		return view('about',compact('data'));
	}
    
    public function contact()
	{
		$data = "Contact";
		return view('contact',compact('data'));
	}
}
