<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
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
    $this->data['users'] = $this->adminModel->getDetails();
    $this->data['users_deleted'] = $this->adminModel->onlyDeleted()->getDetails();
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['roles'] = $this->roleModel->get();
    $this->data['offices'] = $this->officeModel->get();
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

  public function delete($id)
  {
    if($this->adminModel->softDeleteByUserId($id))
    {
      if ($this->userModel->softDelete($id)) {
        $this->session->setFlashData('success_message', 'Successfully deleted user');
      }
    }
    else
    {
      die('Something went wrong');
    }
    return redirect()->to(base_url('users'));
  }

  public function restore($id)
  {
    if($this->adminModel->restoreByUserId($id))
    {
      if ($this->userModel->restore($id)) {
        $this->session->setFlashData('success_message', 'Successfully restored user');
      }
    }
    else
    {
      die('Something went wrong');
    }
    return redirect()->to(base_url('users'));
  }

  public function updatePassword()
  {
    $users = $this->userModel->get(['id' => $_SESSION['user_id']]);
    if($this->validate('password') || password_verify($_POST['old_password'], $users[0]['password']))
    {
      if($this->userModel->edit(['password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT)], $_SESSION['user_id']))
      {
        $data['message'] = 'Sucessfully Editd Password';
      }
      else
      {
        $data['message'] = 'Something Went Wrong!';
      }
    }
    else
    {
      $data['error'] = $this->validation->getErrors();
      if(!password_verify($_POST['old_password'], $users[0]['password']))
        $data['error']['old_password'] = 'Incorrect Password';
    }
    return view('userTemplate\passwordForm', $data);
  }

}
