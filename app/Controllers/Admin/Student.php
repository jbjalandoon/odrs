<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Student extends BaseController
{

	function __construct(){
		return $this->redirectRole('admin', 2);
	}

	public function index()
	{
		$data['students'] = $this->student->getDetail();
		if($this->isAjax()){
			return view('admin/student/index', $data);
		}
		echo view('admin/template/header');
		echo view('admin/student/index', $data);
		return view('admin/template/footer');
	}

	public function alumni()
	{

		if($_SESSION['role_id'] != 2 || !isset($_SESSION['role_id']))
			return view('errors/html/error_404');

		$data['students'] = $this->student->getDetail();

		if($this->isAjax()){
			return view('admin/student/alumni',$data);
		}
		echo view('admin/template/header');
		echo view('admin/student/alumni',$data);
		return view('admin/template/footer');
	}


}
