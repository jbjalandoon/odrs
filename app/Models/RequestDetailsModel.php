<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class RequestDetailsModel extends BaseModel
{

  protected $table = 'request_details';

  protected $allowedFields = ['id', 'request_id', 'document_id', 'status', 'quantity' , 'page','printed_at', 'received_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [], $id = null){

    $this->select('request_details.*,documents.note, documents.price,requests.created_at as requested_at, requests.reason, documents.document, documents.price, documents.note, students.firstname, students.lastname, students.student_number, courses.course, courses.abbreviation');
    $this->join('requests', 'request_id = requests.id');
    $this->join('documents', 'document_id = documents.id');
    $this->join('students', 'requests.student_id = students.id');
    $this->join('courses', 'students.course_id = courses.id');
    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }
    if ($id != null)
      $this->where('id', $id);
    return $this->findAll();
  }

  public function getReports($type, $date){

    $this->select('request_details.*,documents.note, documents.price,requests.created_at as requested_at, requests.reason, documents.document, documents.price, documents.note, students.firstname, students.lastname, students.student_number, courses.course, courses.abbreviation');
    $this->join('requests', 'request_id = requests.id');
    $this->join('documents', 'document_id = documents.id');
    $this->join('students', 'requests.student_id = students.id');
    $this->join('courses', 'students.course_id = courses.id');
    if($type == 'yearly'){
      $this->where('year(request_details.printed_at)', $date);
    } else if ($type == 'monthly') {
      $slice = explode('-', $date);
      $this->where('month(request_details.printed_at)', $slice[1]);
      $this->where('year(request_details.printed_at)', $slice[0]);
    } else {
      $this->where('date(request_details.printed_at)', $date);
    }
    return $this->findAll();
  }

  public function sofDeleteByRequestId($id){
    $this->where('request_id', $id);
    return $this->delete();
  }

}
