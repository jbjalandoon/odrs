<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{

  public function index()
  {
    $this->data['users'] = $this->adminModel->getDetails();
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['roles'] = $this->roleModel->get();
    $this->data['view'] = 'Modules\UserManagement\Views\users\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('user'))
      {
        if($this->userModel->inputDetails($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully Created a User Account');
          return redirect()->to(base_url('users'));
        }
        else 
        {
          die('Something Went Wrong!');
        }
      }
      else 
      {
        $this->data['error'] = $this->validation->getErrors();
        $this->data['value'] = $_POST;
      }
    
    }
    
    return view('template\index', $this->data);
  }

}
