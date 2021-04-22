<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class RequestsModel extends BaseModel
{

  protected $table = 'requests';

  protected $allowedFields = ['id', 'slugs', 'student_id', 'reason', 'status', 'completed_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($condition = [], $id = null){
    $this->select('requests.id, requests.slugs, students.firstname,students.middlename, students.student_number, students.lastname,requests.completed_at, requests.reason, requests.created_at, courses.course, courses.abbreviation, requests.status');
    $this->join('students', 'students.id = student_id');
    $this->join('courses', 'courses.id = students.course_id');
    foreach ($condition as $condition => $value) {
      $this->where($condition, $value);
    }
    if ($id != null)
      $this->where('requests.id', $id);
    return $this->findAll();
  }

  public function getBySlugs($slugs){
    $this->select('id, slugs');
    $this->where('slugs', $slugs);
    return $this->findAll();
  }

}
