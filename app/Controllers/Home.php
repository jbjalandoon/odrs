<?php

namespace App\Controllers;

class Home extends BaseController
{

	function __construct(){
	}

	public function index()
	{
		if (isset($_SESSION['user_id'])) {
			header('Location: '.$_SESSION['landing_page']);
			exit();
		}
		return view('home/index');
	}

	public function logout(){
		session_destroy();
		return redirect()->to(base_url());
	}

	public function verification(){
		if($this->validate('login')){
			$users = $this->userModel->getUsername($_POST['username']);
			if(!empty($users))
			{
				foreach($users as $user)
				{
					if(password_verify($_POST['password'], $user['password']))
					{
						if ($user['status'] == 'a') {
							if ($user['identifier'] == 'students') {
								$students = $this->studentModel->getStudentByUserId($user['id']);
								$this->session->set([
									'user_id' => $user['id'],
									'role_id' => $user['role_id'],
									'username' => $user['username'],
									'role' => $user['role'],
									'identifier' => $user['identifier'],
									'student_id' => $students[0]['id'],
									'landing_page' => $user['landing_page'],
									'student_number' => $students[0]['student_number'],
									'name' => $students[0]['firstname'] . ' ' . $students[0]['lastname'],
								]);
							} else {
								$admins = $this->adminModel->getAdminByUserId($user['id']);
								$this->session->set([
									'user_id' => $user['id'],
									'username' => $user['username'],
									'identifier' => $user['identifier'],
									'role_id' => $user['role_id'],
									'office_id' => $user['office_id'],
									'role' => $user['role'],
									'admin_id' => $admins[0]['id'],
									'landing_page' => $user['landing_page'],
									'name' => $admins[0]['firstname'] . ' ' . $admins[0]['lastname'],
								]);
							}
							return redirect()->to(base_url($user['landing_page']));
						} else {
							$this->session->setFlashdata('error_login', 'This account is inactive');
							return redirect()->to(base_url());
						}
					} else {
						$this->session->setFlashdata('error_login', 'Username or password is incorrect');
						return redirect()->to(base_url());
					}
				}
			}
			else {
				$this->session->setFlashdata('error_login', 'Username or password is incorrecta');
				return redirect()->to( base_url());
			}
		} else {
			$this->session->setFlashdata('error_login', 'Something Went Wrong!');
			return redirect()->to( base_url());
		}
	}

	public function signUp(){
		$data['courses'] = $this->course->get();
		$data['errors'] = $this->validation->getErrors();
		return view('home/register', $data);
	}

	public function register(){
		if (!$this->validate('register')) {
			$data['courses'] = $this->course->get();
			$data['errors'] = $this->validation->getErrors();
			return view('home/register', $data);
		} else {
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$_POST['student_number'] = $_POST['username'];
			$_POST['token'] = md5(date("Y-m-d h:i:sa") . $_POST['student_number']);
			$_POST['user_id'] = $this->user->input($_POST, 'id');

			if ($this->student->input($_POST)) {
				return redirect()->to(base_url());
			} else {
				die('Error in Creating Account');
			}
		}
	}
}
