<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
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
		$users = $user->where('username', $username)->first();

		$siswa = new SiswaModel();
		$siswas = $siswa->where([
			'nis' => $username,
			'nis' => $password,
		])->first();
		if ($users) {
			$session = session();
			if (password_verify($password, $users['password'])) {
				//create session
				$user = new GuruModel();
				$dt = $user->where([
					'user_id' => $users['id'],
				])->first();
				if ($dt['status'] == 'Disetujui') {
					if (empty($dt['id'])) {
						$login = [
							'islogin' => true,
							'id' => $users['id'],
							'username' => $users['username'],
							'email' => $users['email'],
							'name' => $users['name'],
							'level' => $users['level'],
						];
					} else {
						$login = [
							'islogin' => true,
							'id' => $users['id'],
							'username' => $users['username'],
							'email' => $users['email'],
							'name' => $users['name'],
							'level' => $users['level'],
							'id_guru' => $dt['id'],
							'foto' => $dt['foto'],
						];
					}
					$session->set($login);
					return redirect()->to('/dashboard');
				} else {
					$session->setFlashdata('msg', 'Akun belum disetujui KEPSEK');
					return redirect()->to('/login');
				}
			} else {
				$session->setFlashdata('msg', 'Email/Password invalid');
				return redirect()->to('/login');
			}
		} else if ($siswas) {
			$session = session();
			//create session
			$siswa = new SiswaModel();
			$dt = $siswa->where('id', $siswas['id'])->first();
			if (empty($dt['id'])) {
				$login = [
					'islogin' => true,
					'id' => $siswas['id'],
					'username' => $siswas['nis'],
					'name' => $siswas['nama'],
					'level' => 'Siswa',
				];
			} else {
				$login = [
					'islogin' => true,
					'id' => $siswas['id'],
					'username' => $siswas['nis'],
					'name' => $siswas['nama'],
					'level' => "Siswa",
					'id_siswa' => $dt['id'],
					'foto' => $dt['foto'],
				];
			}
			$session->set($login);
			return redirect()->to('/dashboard');
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
