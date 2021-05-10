<?php
namespace Modules\StudentManagement\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Students extends BaseController
{
    public function index()
    {
        $this->data['view'] = 'Modules\StudentManagement\Views\students\index';
        return view('template/index', $this->data);
    }

    public function add()
    {
        $this->data['edit'] = false;
        $this->data['view'] = 'Modules\StudentManagement\Views\students\form';
        return view('template/index', $this->data);
    }

    public function insertSpreadsheet()
    {

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
                'gender' =>  $value[4],                
                'birthdate' =>  date($value[5]),                
                'contact' =>  $value[6],                
                'level' =>  $value[7],
                'academic_status' => 1,
                'course_id' => 1,

            ];
            array_push($data, $temp);
        }

        foreach($data as $key => $value)
        {
            $userData = [
                'username' => $data[$key]['student_number'],
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'email' => 'email@gmail.com',
                'role_id' => 4
            ];
            $data[$key]['user_id'] = $this->userModel->insert($userData, 'id');
            $this->studentModel->insert($data[$key]);
        }

        echo "<pre>";
        print_r($data); 
        die();
    }
}
