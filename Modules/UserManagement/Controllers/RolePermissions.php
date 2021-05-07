<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class RolePermissions extends BaseController
{

  public function index()
  {
    $this->data['roles'] = $this->roleModel->get();
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['permissions'] = $this->rolePermissionModel->get();
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

  public function edit($id)
  {
    $this->data['edit'] = true;
    $this->data['value'] = $this->roleModel->get(['id' => $id])[0];
    $this->data['permissions'] = $this->permissionModel->get();
    $this->data['modules'] = $this->moduleModel->get();
    $this->data['role_permissions'] = $this->rolePermissionModel->getDetails(['roles.id' => $id]);
    $this->data['view'] = 'Modules\UserManagement\Views\permissions\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->rolePermission->softDeleteByRoleId($id)) {
        if(!empty($_POST['permission_id'])){
          foreach ($_POST['permission_id'] as $key => $value) {
            $permission = $this->rolePermission->get(['role_id' => $id, 'permission_id' => $value]);
            if (!empty($permission)) {
              $this->rolePermission->EditByModuleId(['deleted_at' => null],$value);
            } else {
              $this->rolePermission->input(['role_id' => $id, 'permission_id' => $value]);
            }
          }
        }
      } else {
        die('Something Went Wrong!');
      }
      $this->session->setFlashData('success_message', 'Successfully Edited a role');
      return redirect()->to(base_url('role-permissions'));
    }
    return view('template\index', $this->data);
  }

  public function delete($id)
  {

  }

  public function retrieve(){
    $data['permissions'] = $this->rolePermissionModel->getDetails(['role_permissions.role_id' => $_GET['id']]);
    $data['permission_types'] = $this->rolePermissionModel->getTypes(['role_permissions.role_id' => $_GET['id']]);
    $data['modules'] = $this->rolePermissionModel->getModules(['role_permissions.role_id' => $_GET['id']]);

    return view('Modules\UserManagement\Views\permissions\permissions', $data);
  }

}
