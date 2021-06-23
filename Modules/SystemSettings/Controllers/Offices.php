<?php
namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;

class Offices extends BaseController
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
    $this->data['offices'] = $this->officeModel->get();
    $this->data['view'] = 'Modules\SystemSettings\Views\offices\index';
    return view('template/index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\SystemSettings\Views\offices\form';

    if($this->request->getMethod() == 'post')
    {
      if($this->validate('office'))
      {
        if($this->officeModel->input($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully added Offices');
          return redirect()->to(base_url('offices'));
        }
        else
        {
          die('Something Went Wrong!');
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

  public function edit($id)
  {
    $this->data['edit'] = true;
    $this->data['value'] = $this->officeModel->get(['id' => $id])[0];
    $this->data['view'] = 'Modules\SystemSettings\Views\offices\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('office'))
      {
        if($this->officeModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully edited office');
          return redirect()->to(base_url('offices'));
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
    return view('template\index', $this->data);
  }

  public function delete($id)
  {
    if($this->office_model->softDelete($id))
    {
      $this->setFlashData('success_message', 'Successfully Deleted');
    }
    else
    {
      die('Something went wrong!');
    }
    return redirect()->to(base_url('offices'));
  }

}
