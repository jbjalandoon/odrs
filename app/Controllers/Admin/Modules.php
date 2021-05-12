<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
/**
 *
 */
class Modules extends BaseController
{

  public function index(){

    $data['modules'] = $this->module->get();
    if ($this->isAjax()) {
      return view('admin/modules/index', $data);
    } else {
      echo view('admin/template/header');
      echo view('admin/modules/index', $data);
      return view('admin/template/footer');
    }

  }

  public function add(){

    // if (!$this->redirectRole('add-module')) {
    //   return view('errors/html/error_404');
    // }

    $data['edit'] = false;
    if ($this->request->getMethod() === 'get') {
      echo view('admin/template/header');
      echo view('admin/modules/form', $data);
      return view('admin/template/footer');
    } else {
      if ($this->validate('module')) {
        if ($this->module->input($_POST)) {
          $this->session->setFlashData('success_message', 'Successfully added a module!');
          return redirect()->to(base_url('admin/modules'));
        } else {
          die('Something Went Wrong!');
        }
      } else {
        $data['value'] = $_POST;
        $data['error'] = $this->validation->getErrors();
        echo view('admin/template/header');
        echo view('admin/modules/form', $data);
        return view('admin/template/footer');
      }
    }
  }

  public function edit($id){

    // if (!$this->redirectRole('edit-module')) {
    //   return view('errors/html/error_404');
    // }

    $data['edit'] = true;
    $data['value'] = $this->module->get(['id' => $id])[0];
    if ($this->request->getMethod() == 'get') {
      echo view('admin/template/header');
      echo view('admin/modules/form', $data);
      return view('admin/template/footer');
    } else {
      if ($this->validate('module')) {
        if ($this->module->edit($_POST, $id)) {
          $this->session->setFlashData('success_message', 'Successfully edited a module');
          return redirect()->to(base_url('admin/modules'));
        } else {
          die('Something Went Wrong!');
        }
      } else {
        $data['error'] = $this->validation->getErrors();
        echo view('admin/template/header');
        echo view('admin/modules/form', $data);
        return view('admin/template/footer');
      }
    }
  }

  public function delete($id){

    if (!$this->redirectRole('archive-module')) {
      return view('errors/html/error_404');
    }

    if ($this->module->softDelete($id)) {
      $this->session->setFlashData('success_message', 'Successfully deleted a module');
      return redirect()->to(base_url('admin/modules'));
    } else {
      die('Something went wrong!');
    }
  }

}
