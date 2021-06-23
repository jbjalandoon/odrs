<?php
namespace Modules\ModuleManagement\Controllers;

use App\Controllers\BaseController;

class Modules extends BaseController
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
    $this->data['view'] = 'Modules\ModuleManagement\Views\modules\index';
    $this->data['modules'] = $this->moduleModel->get();
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\ModuleManagement\Views\modules\form';
    if ($this->request->getMethod() === 'post') {
      if ($this->validate('module')) {
        if ($this->moduleModel->input($_POST)) {
          $this->session->setFlashData('success_message', 'Successfully added a module!');
          return redirect()->to(base_url('modules'));
        } else {
          die('Something Went Wrong!');
        }
      } else {
        $this->data['value'] = $_POST;
        $this->data['error'] = $this->validation->getErrors();
        $this->data['view'] = 'Modules\ModuleManagement\Views\modules\form';
      }
    }
    return view('template\index', $this->data);
  }
}
