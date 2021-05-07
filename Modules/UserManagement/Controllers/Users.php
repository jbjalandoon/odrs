<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{

  public function index()
  {
    $this->date['users'] = $this->user->get(['identifier !=' => 'students']);
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('template\index', $this->data);
  }

}
