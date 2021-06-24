<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Roles extends BaseController
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
    $this->data['view'] = 'Modules\UserManagement\Views\roles\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\UserManagement\Views\roles\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('role')) {
        if ($this->roleModel->input($_POST)) {
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
    $this->data['id'] = $id;
    $this->data['view'] = 'Modules\UserManagement\Views\roles\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('role'))
      {
        if($this->roleModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully edited role');
          return redirect()->to(base_url('roles'));
        }
        else
        {
          die('Something went wrong!');
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

  public function delete($id)
  {
    if($this->roleModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted role');
    }
    else
    {
      die('Something went wrong');
    }
    return redirect()->to(base_url('roles'));
  }


}
