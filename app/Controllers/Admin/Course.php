<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Course extends BaseController
{

	public function index()
	{
		if ($this->isAjax()) {
			return view('admin/course/index');
		}
		echo view('admin/template/header');
		echo view('admin/course/index');
		return view('admin/template/footer');
	}


}
