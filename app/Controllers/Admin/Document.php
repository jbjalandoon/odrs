<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Document extends BaseController
{

	public function index()
	{
		$data['documents'] = $this->document->get();
		$data['document_requirements'] = $this->documentRequirement->getDetails();
		if ($this->isAjax()) {
			return view('admin/document/index', $data);
		}
		echo view('admin/template/header');
		echo view('admin/document/index', $data);
		return view('admin/template/footer');
	}

}
