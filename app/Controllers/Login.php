<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
	{
		return view('login');
	}

	public function doLogin()
	{
		$username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
		
		$user = new UserModel();
		$data = $user->where('username', $username)->first();
		if( $data )
		{
			$session = session();
			if( password_verify($password, $data['password']) )
			{
                                //create session
								$user = new GuruModel();
								$dt = $user->where([
									'user_id'=>$data['id'],
								])->first();
				if(empty($dt['id'])){
					$login = [
						'islogin' => true,
						'id'=> $data['id'],
						'username'=> $data['username'],
						'email'=> $data['email'],
						'name' => $data['name'],
						'level' => $data['level'],
					];
				}else{
					$login = [
						'islogin' => true,
						'id'=> $data['id'],
						'username'=> $data['username'],
						'email'=> $data['email'],
						'name' => $data['name'],
						'level' => $data['level'],
						'id_guru' => $dt['id'],
						'wakel' => $dt['wakel'],
						'foto' => $dt['foto'],
					];
				}
				$session->set($login);
				return redirect()->to('/dashboard');
			}else{
				$session->setFlashdata('msg', 'Email/Password invalid');
                return redirect()->to('/login');
			}
		}
	}

	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
