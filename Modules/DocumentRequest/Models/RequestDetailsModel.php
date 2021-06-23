<?php

namespace Modules\DocumentRequest\Models;
use App\Models\BaseModel;

/**
 *
 */
class RequestDetailsModel extends BaseModel
{

  protected $table = 'request_details';

  protected $allowedFields = ['id', 'request_id','free', 'document_id', 'remark', 'status', 'quantity' , 'page','printed_at', 'received_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [], $id = null){

    $this->select('request_details.*, documents.price,requests.created_at as requested_at, requests.reason, documents.document,documents.per_page_payment,documents.template, documents.price, students.firstname, students.lastname, students.student_number, students.gender ,courses.course, courses.abbreviation');
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

  public function printRequest($id, $data)
  {
    $this->transStart();

      $this->update($id, $data);

    $this->transComplete();

    return $this->transStatus();
  }

  public function claimRequest($data){
    $this->transStart();
      foreach($data as $key){
        $this->update($key, ['status' => 'c', 'received_at' => date("Y-m-d H:i:s")]);
      }

    $this->transComplete();

    return $this->transStatus();
  }

  public function getReports($type, $date, $document){

    $this->select('request_details.*, documents.price,requests.created_at as requested_at, requests.reason, documents.document, documents.price, students.firstname, students.lastname, students.student_number, courses.course, courses.abbreviation');
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
    $this->where('request_details.document_id', $document);
    return $this->findAll();
  }

  public function sofDeleteByRequestId($id){
    $this->where('request_id', $id);
    return $this->delete();
  }

}
