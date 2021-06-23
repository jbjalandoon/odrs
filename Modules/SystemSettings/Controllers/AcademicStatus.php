<?php
namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;

class AcademicStatus extends BaseController
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
    $this->data['academic_statuses'] = $this->academicStatusModel->get();
    $this->data['view'] = 'Modules\SystemSettings\Views\academicstatus\index';
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\SystemSettings\Views\academicstatus\form';

    if($this->request->getMethod() == 'post')
    {
      if($this->validate('academicStatus'))
      {
        if($this->academicStatusModel->input($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully added Academic Status');
          return redirect()->to(base_url('academic-status'));
        }
        else
        {
          die("Something Went Wrong!");
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

  public function edit($id)
  {
    $this->data['edit'] = true;
    $this->data['value'] = $this->academicStatusModel->get(['id' => $id]);
    $this->data['view'] = 'Modules\SystemSettings\Views\academicstatus\form';

    if($this->request->getMethod() == 'post')
    {
      if($this->validate('academicStatus'))
      {
        if($this->academicStatusModel($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully edited Academic Status');
          return redirect()->to(base_url('academic-status'));
        }
      }
      else
      {
        $this->data['value'] = $_POST;
        $this->data['error'] = $this->validation->getErrors();
      }
    }

    return view('template\data', $this->data);
  }

  public function delete($id)
  {
    if($this->academicStatusModel->softDelete($id))
    {
      $this->session->setFlash('success_message', 'Successfully deleted');
    }
    else
    {
      die('Something Went Wrong!');
    }
    return redirect()->to(base_url('academic-status'));
  }

}
