<?php
namespace Modules\SystemSettings\Controllers;

use App\Controllers\BaseController;

class CourseTypes extends BaseController
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
    $this->data['view'] = 'Modules\SystemSettings\Views\coursetypes\index';
    $this->data['types'] = $this->courseTypeModel->get();
    $this->data['types_deleted'] = $this->courseTypeModel->onlyDeleted()->get();
    return view('template\index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\SystemSettings\Views\coursetypes\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('courseType'))
      {
        if($this->courseTypeModel->input($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully Added Course Type');
          return redirect()->to(base_url('course-types'));
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
    $this->data['value'] = $this->courseTypeModel->get(['id' => $id])[0];
    $this->data['id'] = $id;
    $this->data['view'] = 'Modules\SystemSettings\Views\coursetypes\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('courseType'))
      {
        if($this->courseTypeModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully Edited Course Type');
          return redirect()->to(base_url('course-types'));
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

  public function delete($id)
  {
    if($this->courseTypeModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted Course Type');
    }
    else
    {
      die('Something Went Wrong!');
    }
    return redirect()->to(base_url('course-types'));
  }

}
