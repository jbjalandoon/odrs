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

    public function delete($id)
    {
      if($this->studentModel->softDeleteByUserId($id))
      {
        if ($this->userModel->softDelete($id)) {
          $this->session->setFlashData('success_message', 'Successfully deleted student');
        }
      }
      else
      {
        die('Something went wrong');
      }
      return redirect()->to(base_url('students'));
    }

    public function insertSpreadsheet()
    {
        if($this->validate('student_spreadsheet')){
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->request->getFile('students'));
            $xlsx = new Xlsx($spreadsheet);
            $array = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            $ctr = 0;
            foreach($array as $key => $value)
            {
                $student = $this->userModel->getCount($value[0], $value[5]);
                if ($student != 0) {
                  $ctr++;
                  continue;
                }
                if($key == 0)
                    continue;
                $temp = [
                    'student_number' =>  $value[0],
                    'firstname' =>  $value[1],
                    'middlename' =>  $value[2],
                    'lastname' =>  $value[3],
                    'suffix' =>  $value[4],
                    'email' =>  $value[5],

                ];
                array_push($data, $temp);
            }

            if($this->userModel->inputDetailBulk($data)){
              $response = [
                'status' => 'success',
                'inserted_count' => count($data),
                'insert_count' => count($array) - 1,
                'exisiting_count' => $ctr,
                'data' => json_encode($data),
                'message' => 'Successfully Inserted',

              ];

              return json_encode($response);
            } else {
              $response = [
                'status' => 'error',
                'inserted_count' => 0,
                'insert_count' => count($array),
                'exisiting_count' => $ctr,
                'data' => null,
                'message' => 'Please check the format of each data in spreadsheet',
              ];
              return json_encode($response);
            }
        } else {
          $response = [
            'status' => 'error',
            'inserted_count' => 0,
            'insert_count' => count($array),
            'exisiting_count' => $ctr,
            'message' => 'Wrong File Format',
            'data' => json_encode($this->validation->getErrors()),
          ];
          return json_encode($response);
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

    public function editOwn(){
      $this->data['value'] = $this->studentModel->get(['students.id' => $_SESSION['student_id']])[0];
      $user = $this->userModel->get(['users.id' => $_SESSION['user_id']])[0];
      array_push($this->data['value'], $user['email']);

      $this->data['courses'] = $this->courseModel->get();
      $this->data['view'] = 'Modules\StudentManagement\Views\students\profileform';
      if ($this->request->getMethod() == 'post') {
        if ($this->validate('user_own')) {
          if ($this->studentModel->editOwn($_POST)) {
            $this->session->setFlashData('success_message', 'successfully edited your information');
            return redirect()->to(base_url('requests/new'));
          } else {
            die('Something Went Wrong!');
          }
        } else {
          $this->data['error'] = $this->validation->getErrors();
          $this->data['value'] = $_POST;
          $this->data['value'][0] = $_POST['email'];
        }
      }
      return view('template/index', $this->data);
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
