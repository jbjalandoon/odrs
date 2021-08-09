<?php
namespace Modules\DocumentManagement\Controllers;

use App\Controllers\BaseController;

class Notes extends BaseController
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
    $this->data['notes'] = $this->noteModel->get();
    $this->data['notes_deleted'] = $this->noteModel->onlyDeleted()->get();
    $this->data['view'] = 'Modules\DocumentManagement\Views\notes\index';

    return view('template/index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\DocumentManagement\Views\notes\form';

    if($this->request->getMethod() == 'post')
    {
      if($this->validate('note'))
      {
        if($this->noteModel->input($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully added notes');
          return redirect()->to(base_url('documents'));
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

    return view('template/index', $this->data);
  }

  public function edit($id)
  {
    $this->data['edit'] = true;
    $this->data['value'] = $this->noteModel->get(['id' => $id])[0];
    $this->data['id'] = $id;
    $this->data['view'] = 'Modules\DocumentManagement\Views\notes\form';

    if($this->request->getMethod() == 'post')
    {
      if($this->validate('note'))
      {
        if($this->noteModel->edit($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully edited note');
          return redirect()->to(base_url('documents'));
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

    return view('template/index', $this->data);
  }

  function delete($id)
  {
    if($this->noteModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted notes');

    }
    else
    {
      die('Something went wrong!');
    }
    return redirect()->to(base_url('notes'));
  }

  function restore($id)
  {
    if($this->noteModel->restore($id))
    {
      $this->session->setFlashData('success_message', 'Successfully resore notes');

    }
    else
    {
      die('Something went wrong!');
    }
    return redirect()->to(base_url('notes'));
  }

}
