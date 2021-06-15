<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
/**
 *
 */
class Roles extends BaseController
{

  public function index(){

    $data['roles'] = $this->role->get();
    $data['permissions'] = $this->permission->getDetails();
    if ($this->isAjax()) {
      return view('admin/roles/index', $data);
    } else {
      echo view('admin/template/header');
      echo view('admin/roles/index', $data);
      return view('admin/template/footer');
    }

  }

  public function add(){

    if (!$this->redirectRole('add-roles')) {
      return view('errors/html/error_404');
    }

    $data['edit'] = false;
    $data['modules'] = $this->module->get();
    if ($this->request->getMethod() === 'get') {
      echo view('admin/template/header');
      echo view('admin/roles/form', $data);
      return view('admin/template/footer');
    } else {
      if ($this->validate('role')) {
        // echo "<pre>";
        // print_r($_POST['module_id']);
        // die();
        $role_id = $this->role->input($_POST, true);
        foreach ($_POST['module_id'] as $index => $value) {
          $this->permission->input(['role_id' => $role_id, 'module_id' => $value]);
        }
        $this->sessions->setFlashData('success_message', 'Successfully added a role');
        return redirect()->to(base_url('admin/role'));
      } else {
        $data['errors'] = $this->validation->getErrors();
        echo view('admin/template/header');
        echo view('admin/roles/form', $data);
        return view('admin/template/footer');
      }
    }
  }

  public function edit($id){
    $data['edit'] = true;
    $data['value'] = $this->role->get(['id' => $id])[0];
    $data['modules'] = $this->module->get();
    $data['permissions'] = $this->permission->getDetails(['roles.id' => $id]);

    if ($this->request->getMethod() === 'get') {
      echo view('admin/template/header');
      echo view('admin/roles/form', $data);
      return view('admin/template/footer');
    } else {
      if ($this->validate('role')) {
        if ($this->role->edit($_POST, $id)) {
          $this->permission->softDeleteByRoleId($id);
          if(!empty($_POST['module_id'])){
            foreach ($_POST['module_id'] as $key => $value) {
              $permission = $this->permission->get(['role_id' => $id, 'module_id' => $value]);
              if (!empty($permission)) {
                $this->permission->EditByModuleId(['deleted_at' => null],$value);
              } else {
                $this->permission->input(['role_id' => $id, 'module_id' => $value]);
              }
            }
          }
        } else {
          die('Something Went Wrong');
        }
        $this->session->setFlashData('success_message', 'Successfully Edited a role');
        return redirect()->to(base_url('admin/roles'));
      } else {
        $data['errors'] = $this->validation->getErrors();
        echo view('admin/template/header');
        echo view('admin/roles/form', $data);
        return view('admin/template/footer');
      }
    }
  }

}
