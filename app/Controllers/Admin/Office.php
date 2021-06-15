<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Office extends BaseController
{

	function __construct(){
		$this->redirectRole('admin', 2);
	}

	public function index()
	{
		if ($this->isAjax()) {
			return view('admin/office/index');
		}
		echo view('admin/template/header');
		echo view('admin/office/index');
		return view('admin/template/footer');
	}


}
