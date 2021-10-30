<?php

namespace Modules\DocumentRequest\Models;
use App\Models\BaseModel;
use Modules\DocumentManagement\Models\DocumentRequirementsModel;

/**
 *
 */
class FormRequestsModel extends BaseModel
{

  protected $table = 'form_requests';

  protected $allowedFields = ['id', 'student_id', 'school','address','sy_admission','status','remarks', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($condition = [], $id = null){
    $this->select('form_requests.*, students.firstname, students.lastname, students.middlename, students.suffix, courses.abbreviation,courses.course, students.student_number, users.email');
    $this->join('students', 'students.id = form_requests.student_id');
    $this->join('courses', 'courses.id = students.course_id');
    $this->join('users', 'users.id = students.user_id');
    foreach ($condition as $condition => $value) {
      $this->where($condition, $value);
    }
    if ($id != null)
      $this->where('requests.id', $id);
    return $this->findAll();
  }

  public function acceptForm($id)
  {
    return $this->update($id, ['status' => 'o']);
  }

  public function receiveForm($id)
  {
    return $this->update($id, ['status' => 'c']);
  }


}
