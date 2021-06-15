<?php
namespace Modules\UserManagement\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{

  public function index()
  {
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('tempate\index', $this->data);
  }

}
