<?php
namespace Modules\ModuleManagement\Controllers;

use App\Controllers\BaseController;

class PermissionTypes extends BaseController
{

	// public function __construct()
	// {
	// 	parent:: __construct();
	// }

  public function index()
  {
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissionTypes\index';
    $this->data['permissionsTypes'] = $this->permissionTypeModel->get();
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissionTypes\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('permissionType')) {
        if ($this->permissionTypeModel->input($_POST)) {
          $this->session->setFlashData('success_message', 'Successfully added a module!');
          return redirect()->to(base_url('permission-types'));
        } else {
          die('Something Went Wrong!');
        }
      } else {
        $this->data['value'] = $_POST;
        $this->data['error'] = $this->validation->getErrors();
        $this->data['view'] = 'Modules\ModuleManagement\Views\permissionTypes\form';
      }
    }
    return view('template\index', $this->data);
  }

}
