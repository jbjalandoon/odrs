<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class User extends BaseController
{

	function __construct(){
		return $this->redirectRole('admin', 2);
	}

	public function index()
	{

		if($_SESSION['role_id'] != 2 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		// $data['inactive_users'] = $this->student->get('i', 1);
		// $data['active_users'] = $this->student->get('a', null);

		if ($this->isAjax()) {
			return view('admin/user/index');
		}
		echo view('admin/template/header');
		echo view('admin/user/index');
		return view('admin/template/footer');
	}

	public function delete(){

		if($_SESSION['role_id'] != 2 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		if ($this->user->softDelete($_POST['id'])) {
			if($this->student->softDeleteByUserId($_POST['id'])){
				$this->session->setFlashdata('success', 'You have successfuly deleted the account');
			} else {
				$this->session->setFlashdata('error', 'Something Went Wrong!');
			}
		} else {
			$this->session->setFlashdata('error', 'Something Went Wrong!');
		}
		$data['inactive_users'] = $this->student->get('i', 1);
		$data['active_users'] = $this->student->get('a', null);
		return view('admin/user/index', $data);
	}

	public function activate(){

		if($_SESSION['role_id'] != 2 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		if ($this->user->edit(['status' => 'a'], $_POST['id'])) {
			$this->session->setFlashdata('success', 'You have successfuly activated the account');
		} else {
			$this->session->setFlashdata('error', 'Something Went Wrong!');
		}
		$data['inactive_users'] = $this->student->get('i', 1);
		$data['active_users'] = $this->student->get('a', null);
		return view('admin/user/index', $data);

	}

	public function add(){

		if($_SESSION['role_id'] != 2 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$data['offices'] = $this->office->get();
		if ($this->request->getMethod() === 'get') {
			if ($this->isAjax()) {
				return view('admin/user/form', $data);
			} else {
				echo view ('admin/template/header');
				echo view('admin/user/form', $data);
				return view('admin/template/footer');
			}
		} else {
			if($this->validate('user')){
				$data['firstname'] = $_POST['firstname'];
				$data['middlename'] = $_POST['middlename'];
				$data['lastname'] = $_POST['lastname'];
				$data['username'] = $_POST['firstname'] . '' . $_POST['lastname'];
				$data['status'] = 'a';
				$data['email'] = $_POST['email'];
				$data['contact'] = $_POST['contact'];
				$data['office_id'] = $_POST['office_id'];
				$data['role_id'] = 3;
				$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$data['user_id'] = $this->user->input($data);
				 if ($this->admin->input($data)) {
					 $this->session->setFlashdata('success', 'You have successfuly added a account');
					 return redirect()->to(base_url('admin/users'));
				 }
				 else {
					$this->session->setFlashdata('error', 'Something went wrong try again');
					return redirect()->to(base_url('admin/users'));
				}
			} else {
				$data['value'] = $_POST;
				$data['error'] = $this->validation->getErrors();
				echo view ('admin/template/header');
				echo view('admin/user/form', $data);
				return view('admin/template/footer');
			}
		}
	}

	public function edit($id){

	}



}
