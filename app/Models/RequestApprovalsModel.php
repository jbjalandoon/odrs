<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class RequestApprovalsModel extends BaseModel
{

  protected $table = 'request_approvals';

  protected $allowedFields = ['id', 'request_detail_id', 'office_id', 'status'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [], $id = null){
    $this->select('request_approvals.id,request_details.document_id, request_approvals.status, request_approvals.request_detail_id, offices.office, students.student_number, students.firstname, students.lastname, courses.course, documents.document, requests.created_at, offices.id as office_id');
    $this->join('offices', 'office_id = offices.id');
    $this->join('request_details', 'request_detail_id = request_details.id');
    $this->join('documents', 'request_details.document_id = documents.id');
    $this->join('requests', 'request_details.request_id = requests.id');
    $this->join('students', 'requests.student_id = students.id');
    $this->join('courses', 'students.course_id = courses.id');

    foreach ($conditions as $condition => $value) {
      $this->where($condition, $value);
    }
    if ($id != null)
      $this->where('request_approvals.id', $id);

    return $this->findAll();
  }

  public function softDeleteByRequestDetailId($id){
    $this->where('request_detail_id', $id);
    return $this->delete();
  }

}
