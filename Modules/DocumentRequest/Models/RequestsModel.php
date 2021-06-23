<?php

namespace Modules\DocumentRequest\Models;
use App\Models\BaseModel;
use Modules\DocumentManagement\Models\DocumentRequirementsModel;

/**
 *
 */
class RequestsModel extends BaseModel
{

  protected $table = 'requests';

  protected $allowedFields = ['id', 'slug', 'student_id', 'remark','reason', 'status', 'completed_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($condition = [], $id = null){
    $this->select('requests.id, requests.slug, students.firstname,students.middlename, students.student_number, students.lastname,requests.completed_at, requests.reason, requests.created_at, courses.course, courses.abbreviation, requests.status');
    $this->join('students', 'students.id = student_id');
    $this->join('courses', 'courses.id = students.course_id');
    foreach ($condition as $condition => $value) {
      $this->where($condition, $value);
    }
    if ($id != null)
      $this->where('requests.id', $id);
    return $this->findAll();
  }

  public function confirmRequest($data)
  {
    $this->transStart();
    foreach ($data as $index){
      $this->update($index[0], ['status' => 'c']);
    }

    $this->transComplete();

    return $this->transStatus();
  }

  public function denyRequest($data)
  {
    $this->transStart();
      $details = new RequestDetailsModel();
      $approvals = new RequestApprovalsModel();
      $details->set(['status' => 'd']);
      $details->select('id');
      $details->where('request_id', $data['id']);
      $approvals->set(['status' => 'd']);
      foreach($details->findAll() as $detail)
      {
        $approvals->orWhere('request_detail_id', $detail['id']);
      }
      if(!empty($approvals->findAll()))
        $approvals->update();
      $details->update();

      $this->update($data['id'], ['status' => 'd' , 'remark' => $data['remark']]);

    $this->transComplete();

    return $this->transStatus();
  }

  public function cancelRequest($id)
  {
    $this->transStart();
      $details = new RequestDetailsModel();
      $approvals = new RequestApprovalsModel();
      $details->select('id');
      foreach($details->findAll() as $detail)
      {
        $approvals->where('request_detail_id', $detail['id'])->delete();
      }
      $details->where('request_id', $id)->delete();

      $this->delete($id);

    $this->transComplete();

    return $this->transStatus();
  }

  public function request($data)
  {
    $this->transStart();

      $requestData =
      [
        'slug' => $data['request']['slug'],
        'student_id' => $data['request']['student_id'],
        'reason' => $data['request']['reason'],
      ];

      $this->insert($requestData);
      $requestID = $this->insertID();

      $requestDetail = new RequestDetailsModel();
      $requestApproval = new RequestApprovalsModel();
      $documentRequirementModel = new documentRequirementsModel();
      foreach($data['request_document'] as $details)
      {

        $documentRequirements = $documentRequirementModel->get(['document_id' => $details['document_id']]);
        $requestDetailData = [
          'request_id' => $requestID,
          'document_id' => $details['document_id'],
          'remark' => null,
          'status' => empty($documentRequirements) ? 'p' : 'a',
          'quantity' => $details['quantity'],
          'free' => $details['free']
        ];
        $requestDetail->insert($requestDetailData);
        $detailID = $requestDetail->getInsertID();

        if(!empty($documentRequirements))
        {
          foreach($documentRequirements as $requirement)
          {
            $requirementData = [
              'office_id' => $requirement['office_id'],
              'request_detail_id' => $detailID,
              'remark' => null
            ];
            $requestApproval->insert($requirementData);
          }
        }
      }

    $this->transComplete();

    return $this->transStatus();
  }

  public function getBySlugs($slugs){
    $this->select('id, slug');
    $this->where('slug', $slugs);
    return $this->findAll();
  }

}
