<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class StudentsModel extends BaseModel
{

  protected $table = 'students';

  protected $allowedFields = ['id', 'student_number', 'firstname', 'lastname', 'middlename', 'gender', 'birthdate', 'contact', 'academic_status', 'course_id', 'user_id', 'status'];

  function __construct(){
    parent::__construct();
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

    $this->select('students.*, courses.course');
    $this->join('courses', 'students.course_id = courses.id');
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
