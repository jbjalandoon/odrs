<?php

namespace Modules\StudentManagement\Models;
use App\Models\BaseModel;
use Modules\UserManagement\Models\UsersModel;
use Modules\StudentManagement\Controllers\Students;

/**
 *
 */
class StudentsModel extends BaseModel
{

  protected $table = 'students';

  protected $allowedFields = ['id', 'student_number', 'firstname', 'lastname', 'middlename', 'gender', 'birthdate', 'contact', 'academic_status', 'course_id', 'user_id', 'status', 'level'];

  function __construct(){
    parent::__construct();
  }

  public function insertStudent($data)
  {
    $this->transBegin();

      $user = new UsersModel();
      $password = random_string('alnum', 8);
      $userData = [
        'username' => $data['student_number'],
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'token' => md5($data['student_number']),
        'email' => $data['email'],
        'role_id' => 4
      ];

      $user->insert($userData);
      $id = $user->getInsertID();

      $data['user_id'] = $id;

      $this->insert($data);

      $student = new Students();
      if($student->sendPassword($password, $data['email']))
      {
        $this->transCommit();
        return true;
      }
      else
      {
        $this->transRollback();
        return false;
      }

  }

  public function editStudents($data)
  {
    $this->transBegin();

      $user = new UsersModel();
      $userData = [
        'email' => $data['email'],
      ];

      $user->insert($userData);
      $id = $user->getInsertID();

      $data['user_id'] = $id;

      $this->insert($data);

      $student = new Students();
      if($student->sendPassword($password, $data['email']))
      {
        $this->transCommit();
        return true;
      }
      else
      {
        $this->transRollback();
        return false;
      }

  }

  public function getStudentByStatus($status, $role){
    $this->select('students.id, students.firstname, students.lastname, students.middlename, students.student_number, students.user_id, students.contact, users.status, users.username,users.email, roles.role');
    $this->join('users', 'users.id = students.user_id');
    $this->join('roles', 'users.role_id = roles.id');
    $this->where('users.status', $status);
    if ($role != null) {
      $this->where('roles.id', $role);
    }
    return $this->findAll();
  }

  public function getDetail($condition = []){

    $this->select('students.*, courses.course, academic_status.status');
    $this->join('courses', 'students.course_id = courses.id');
    $this->join('academic_status', 'students.academic_status = academic_status.id');
    foreach ($condition as $condition => $value) {
      $this->where($condition, $value);
    }
    return $this->findAll();

  }

  public function softDeleteByUserId($id){
    return $this->delete(['user_id' => $id]);
  }

  public function getStudentByUserId($id){
    $this->where('user_id', $id);
    return $this->findAll();
  }

}
