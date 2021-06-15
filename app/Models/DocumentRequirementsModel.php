<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class DocumentRequirementsModel extends BaseModel
{

  protected $table = 'document_requirements';

  protected $allowedFields = ['id', 'office_id', 'document_id'];

  public function getDetails($conditions = [], $id = null){
    $this->select('document_requirements.*, offices.office');
    $this->join('offices', 'document_requirements.office_id = offices.id');

    foreach ($conditions as $condition => $value) {
      $this->where($condition, $value);
    }
    if ($id != null)
      $this->where('request_approvals.id', $id);

    return $this->findAll();
  }

}
