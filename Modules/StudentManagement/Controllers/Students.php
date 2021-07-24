<?php
namespace Modules\StudentManagement\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Students extends BaseController
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
        $this->data['students'] = $this->studentModel->getDetail();
        $this->data['courses'] = $this->courseModel->get();
        $this->data['academic_status'] = $this->academicStatusModel->get();
        $this->data['view'] = 'Modules\StudentManagement\Views\students\index';
        return view('template/index', $this->data);
    }

    public function add()
    {
      $this->data['courses'] = $this->courseModel->get();
      $this->data['academic_status'] = $this->academicStatusModel->get();
      $this->data['edit'] = false;
      $this->data['view'] = 'Modules\StudentManagement\Views\students\form';
      if($this->request->getMethod() == 'post')
      {
        if($this->validate('student'))
        {
          if($this->studentModel->insertStudent($_POST))
          {
            $this->session->setFlashData('success_message', 'Successfully Added Student');
            return redirect()->to(base_url('students'));
          }
          else
          {
            die('Something Went Wrong!');
          }
        }
        else
        {
          $this->data['errors'] = $this->validation->getErrors();
          $this->data['value'] = $_POST;
        }
      }
      return view('template/index', $this->data);
    }

    public function insertSpreadsheet()
    {
        if($this->validate('student_spreadsheet')){
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->request->getFile('students'));
            $xlsx = new Xlsx($spreadsheet);
            $array = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            foreach($array as $key => $value)
            {
                if($key == 0)
                    continue;
                $temp = [
                    'student_number' =>  $value[0],
                    'firstname' =>  $value[1],
                    'lastname' =>  $value[2],
                    'middlename' =>  $value[3],
                    'email' =>  $value[4],

                ];
                array_push($data, $temp);
            }
            if($this->userModel->inputDetailBulk($data)){
                return redirect()->to(base_url('students'));
            } else {
                die('Something Went Wrong!');
            }
        } else {
          return redirect()->to(base_url('students'));
            // $this->data['error'] = $this->validation->getErrors();
            // $this->data['view'] = 'Modules\StudentManagement\Views\students\index';
            // return view('template/index', $this->data);
        }
    }

    public function setup(){
      if ($this->request->getMethod() == 'post') {
        if ($_POST['status'] == 'enrolled') {
          $_POST['year_graduated'] = null;
        } elseif ($_POST['status'] == 'alumni') {
          $_POST['year_graduated'] = $_POST['level'];
          $_POST['level'] = null;
        } else {
          $_POST['year_graduated'] = null;
          $_POST['level'] = null;
        }
        if ($this->studentModel->edit($_POST, $_SESSION['student_id'])) {
          $data = [
            'status' => 'success',
            'data' => $_POST
          ];
        } else {
          $data = [
            'status' => 'error',
            'data' => $_POST
          ];
        }
        return json_encode($data);
      } else {
        $data['students'] = $this->studentModel->getNull($_SESSION['student_id'])[0];
        $data['courses'] = $this->courseModel->getCourseId();
        foreach ($data['students'] as $key => $value) {
          if ($value != null) {
            unset($data['students'][$key]);
          }
        }
      }
      return json_encode($data);
    }

    public function sendPassword($username = null,$password = null, $email = null)
    {
			$mail = \Config\Services::email();
			$mail->setTo($email);
			$mail->setSubject('User Account Password');
			$mail->setFrom('ODRS', 'PUP-Taguig ODRS');
			$mail->setMessage('Your Account has been sucessfully made! <br> Username: ' .  $username . ' <br> Password: '  . $password);
      if ($mail->send()) {
        return true;
      }
      return false;
    }
}
