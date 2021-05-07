<?php
namespace Modules\ModuleManagement\Controllers;

use App\Controllers\BaseController;

class Permissions extends BaseController
{

	// public function __construct()
	// {
	// 	parent:: __construct();
	// }

  public function index()
  {
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissions\index';
    $this->data['permissions'] = $this->permissionModel->getDetails();
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['permissionTypes'] = $this->permissionTypeModel->get();
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissions\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('permission')) {
        if ($this->permissionModel->input($_POST)) {
          $this->session->setFlashData('success_message', 'Successfully added a permission!');
          return redirect()->to(base_url('permissions'));
        } else {
          die('Something Went Wrong!');
        }
      } else {
        $this->data['value'] = $_POST;
        $this->data['error'] = $this->validation->getErrors();
        $this->data['view'] = 'Modules\ModuleManagement\Views\permissions\form';
      }
    }
    return view('template\index', $this->data);
  }

}
