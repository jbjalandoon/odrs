<?php

namespace Modules\SystemSettings\Models;
use App\Models\BaseModel;

/**
 *
 */
class AcademicStatusModel extends BaseModel
{

  protected $table = 'academic_status';

  protected $allowedFields = ['id', 'status', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

}
