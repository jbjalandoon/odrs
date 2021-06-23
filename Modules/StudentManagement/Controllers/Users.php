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
    $this->data['view'] = 'Modules\UserManagement\Views\users\index';
    return view('tempate\index', $this->data);
  }

}
