<?php
namespace Modules\DocumentManagement\Controllers;

use App\Controllers\BaseController;

class Documents extends BaseController
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
    $this->data['documents'] = $this->documentModel->get();
    $this->data['documents_deleted'] = $this->documentModel->onlyDeleted()->get();
    $this->data['view'] = 'Modules\DocumentManagement\Views\documents\index';

    return view('template/index', $this->data);
  }

  public function add()
  {
    $this->data['edit'] = false;
    $this->data['view'] = 'Modules\DocumentManagement\Views\documents\form';
    $this->data['notes'] = $this->noteModel->get();
    $this->data['offices'] = $this->officeModel->get();
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('document'))
      {
        $day = $_POST['day'];
        $hour = $_POST['hour'];
        $minute = $_POST['minute'];
        $second = $_POST['second'];
        $second += (($day * 24 + $hour) * 60 + $minute) * 60;
        $_POST['process_day'] = $second;
        if($this->documentModel->insertDocument($_POST))
        {
          $this->session->setFlashData('success_message', 'Successfully added Document');
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
    $this->data['value'] = $this->documentModel->get(['id' => $id])[0];
    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $inputSeconds = $this->data['value']['process_day'];
    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    $this->data['value']['day'] = (int) $days;
    $this->data['value']['hour'] = (int) $hours;
    $this->data['value']['minute'] = (int) $minutes;
    $this->data['value']['second'] = (int) $seconds;

    $this->data['id'] = $id;
    $this->data['notes'] = $this->noteModel->get();
    $this->data['offices'] = $this->officeModel->get();
    $this->data['document_requirements'] = $this->documentRequirementModel->get(['document_id' => $id]);
    $this->data['document_notes'] = $this->documentNoteModel->get(['document_id' => $id]);
    $this->data['view'] = 'Modules\DocumentManagement\Views\documents\form';
    if($this->request->getMethod() == 'post')
    {
      if($this->validate('document'))
      {
        $day = $_POST['day'];
        $hour = $_POST['hour'];
        $minute = $_POST['minute'];
        $second = $_POST['second'];
        $second += (($day * 24 + $hour) * 60 + $minute) * 60;
        $_POST['process_day'] = $second;
        if($this->documentModel->editDocument($_POST, $id))
        {
          $this->session->setFlashData('success_message', 'Successfully edited document');
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

  public function delete($id)
  {
    if($this->documentModel->softDelete($id))
    {
      $this->session->setFlashData('success_message', 'Successfully deleted document');
    }
    else
    {
      die('Something went wrong');
    }
    return redirect()->to(base_url('documents'));
  }

  public function fetchNotes()
  {
    $data['notes'] = $this->documentNoteModel->getDetails(['document_notes.document_id' => $_GET['id']]);
    return view('Modules\DocumentManagement\Views\documents\notes', $data);
  }

  public function fetchRequirements()
  {
    $data['requirements'] = $this->documentRequirementModel->getDetails(['document_requirements.document_id' => $_GET['id']]);
    return view('Modules\DocumentManagement\Views\documents\requirements', $data);
  }

  function restore($id)
  {
    if($this->documentModel->restore($id))
    {
      $this->session->setFlashData('success_message', 'Successfully restore document');

    }
    else
    {
      die('Something went wrong!');
    }
    return redirect()->to(base_url('notes'));
  }

}
