<?php
namespace Modules\ModuleManagement\Controllers;

use App\Controllers\BaseController;

class PermissionTypes extends BaseController
{

  function __construct(){
    $this->session = \Config\Services::session();
    $this->session->start();
    if(!isset($_SESSION['user_id'])){
      header('Location: '.base_url());
      exit();
    }
  }

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
      }
    }
    return view('template\index', $this->data);
  }

  public function edit($id){
    $this->data['edit'] = true;
    $this->data['view'] = 'Modules\ModuleManagement\Views\permissionTypes\form';
    $this->data['value'] = $this->permissionTypeModel->get(['id' => $id])[0];
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('permissionType')) {
        if ($this->permissionTypeModel->edit($id, $_POST)) {
          $this->session->setFlashData('success_message', 'Successfully edited a permission type!');
          return redirect()->to(base_url('permission-types'));
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

  public function delete($id)
  {
    if($this->permissionTypeModel->softDelete($id))
    return redirect()->to(base_url('permission-types'));
  }

}
