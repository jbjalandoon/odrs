<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class RolePermissions extends BaseController
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
    $this->data['roles'] = $this->roleModel->get();
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['permissions'] = $this->permissionModel->get();
    $this->data['permissions_roles'] = $this->rolePermissionModel->get();
    $this->data['permission_types'] = $this->permissionTypeModel->get();
    $this->data['view'] = 'Modules\UserManagement\Views\permissions\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\UserManagement\Views\roles\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('role')) {
        if ($this->role->input($_POST)) {
          $this->session->setFlashData('success_message', 'Successfully added a Role!');
          return redirect()->to(base_url('roles'));
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

  public function edit()
  {
    if ($this->request->getMethod() === 'post') {
      if (!empty($_POST['value'])) {
        foreach($_POST['value'] as $key => $value){
          $_POST['value'][$key] = explode(',', $value);
        }
      }
      if (!$this->rolePermissionModel->softDeleteByRoleId()) {
        die('Something Went Wrong!');
      }
      if (!empty($_POST['value'])) {
        foreach ($_POST['value'] as $data) {
          $this->rolePermissionModel->input(['role_id' => $data[1], 'permission_id' => $data[0]]);
        }
      }
      $this->session->setFlashData('success_message', 'Successfully Edited a role');
    }
    return redirect()->to(base_url('role-permissions'));
  }

  public function delete($id)
  {

  }

  public function retrieve(){
    $data['permissions'] = $this->permissionModel->getDetails();
    $data['own_permissions'] = $this->rolePermissionModel->getDetails(['role_permissions.role_id' => $_GET['id']]);
    $data['permission_types'] = $this->permissionTypeModel->get();
    // $data['permission_types'] = $this->rolePermissionModel->getTypes(['role_permissions.role_id' => $_GET['id']]);
    $data['modules'] = $this->moduleModel->get();
    // $data['modules'] = $this->rolePermissionModel->getModules(['role_permissions.role_id' => $_GET['id']]);

    return view('Modules\UserManagement\Views\permissions\permissions', $data);
  }

}
