<?php
namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;

class Courses extends BaseController
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
    $this->data['courses'] = $this->courseModel->getDetails();
    $this->data['courses_deleted'] = $this->courseModel->onlyDeleted()->getDetails();
    $this->data['view'] = 'Modules\SystemSettings\Views\courses\index';

    return view('template/index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\SystemSettings\Views\courses\form';
    $this->data['types'] = $this->courseTypeModel->get();
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('course'))
      {
        if($this->courseModel->input($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully added course');
          return redirect()->to(base_url('courses'));
        }
        else
        {
          die('Something Went Wrong');
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
    $this->data['value'] = $this->courseModel->get(['id' => $id])[0];
    $this->data['types'] = $this->courseTypeModel->get();
    $this->data['view'] = 'Modules\SystemSettings\Views\courses\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('course'))
      {
        if($this->courseModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully Edited Course');
          return redirect()->to(base_url('courses'));
        }
        else
        {
          die('Something Went Wrong');
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
    if($this->courseModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted course');
    }
    else
    {
      die('Something Went Wrong!');
    }
    return redirect()->to(base_url('courses'));
  }

}
