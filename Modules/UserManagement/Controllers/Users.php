<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{

  public function index()
  {
    $this->date['users'] = $this->adminModel->getDetails(['identifier !=' => 'students']);
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\UserManagement\Views\users\form';
    return view('template\index', $this->data);
  }

}
