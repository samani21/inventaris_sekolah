<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
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
		$name = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		$user = new UserModel();
		$users = $user->where('name', $name)->first();
		echo $users['password'];
		// $siswa = new SiswaModel();
		// $siswas = $siswa->where([
		// 	'nis' => $username,
		// 	'nis' => $password,
		// ])->first();
		if ($users) {
			$session = session();
			if (password_verify($password, $users['password'])) {
				//create session
				$user = new PegawaiModel();
				$dt = $user->where([
					'user_id' => $users['id'],
				])->first();
				if (empty($dt['id'])) {
					$login = [
						'islogin' => true,
						'id' => $users['id'],
						'email' => $users['email'],
						'name' => $users['name'],
						'role' => $users['role'],
					];
				} else {
					$login = [
						'islogin' => true,
						'id' => $users['id'],
						'email' => $users['email'],
						'name' => $users['name'],
						'role' => $users['role'],
						'id_pegawai' => $dt['id'],
						'foto' => $dt['foto'],
					];
				}
				$session->set($login);
				return redirect()->to('/dashboard');
			} else {
				$session->setFlashdata('msg', 'Email/Passwaaaord invalid');
				return redirect()->to('/login');
			}
		} else {
			return redirect()->back();
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/login');
	}
}
