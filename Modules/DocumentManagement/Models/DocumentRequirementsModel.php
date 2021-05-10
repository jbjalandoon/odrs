<?php

namespace Modules\DocumentManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class DocumentRequirementsModel extends BaseModel
{

  protected $table = 'document_requirements';

  protected $allowedFields = ['office_id', 'document_id','deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [])
  {
    $this->select('document_requirements.*, offices.office');

    $this->join('offices', 'document_requirements.office_id = offices.id');

    foreach($conditions as $key => $value)
    {
      $this->where($key, $value);
    }

    return $this->findAll();
  }

}
