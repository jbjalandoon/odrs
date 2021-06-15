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
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['permission_types'] = $this->permissionTypeModel->get();
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
      }
    }
    return view('template\index', $this->data);
  }

  public function edit($id){
    $this->data['edit'] = true;
    $this->data['value'] = $this->permissionModel->get(['id' => $id])[0];
    $this->data['permissionTypes'] = $this->permissionTypeModel->get();
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissions\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('permission'))
      {
        if($this->permissionModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully Edited Permission');
          return redirect()->to(base_url('permissions'));
        }
        else
        {
          die('Something Went Wrong');
        }
      }
      else
      {
        $this->data['value'] = $_POST;
        $this->data['error'] = $this->validation->getErrors();
      }
    }
    return view('template/index', $this->data);
  }

  public function delete($id){
    if($this->permissionModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted permission');
    }
    else
    {
      die('Something Went Wrong!');
    }
    return redirect()->to(base_url('permissions'));
  }

  public function filter(){
    if($_GET['module_id'] == 0 && $_GET['type_id'] == 0){
      $this->data['permissions'] = $this->permissionModel->getDetails();
    } else {
      if($_GET['module_id'] != 0 && $_GET['type_id'] == 0){
        $this->data['permissions'] = $this->permissionModel->getDetails(['module_id' => $_GET['module_id']]);
      } elseif($_GET['type_id'] != 0 && $_GET['module_id'] == 0){
        $this->data['permissions'] = $this->permissionModel->getDetails(['permission_type' => $_GET['type_id']]);
      } else {
        $this->data['permissions'] = $this->permissionModel->getDetails(['module_id' => $_GET['type_id'], 'permission_type' => $_GET['type_id']]);
      }
    }
    return view('Modules\ModuleManagement\Views\permissions\table', $this->data);
  }

}
