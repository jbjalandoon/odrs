<?php

namespace Modules\SystemSettings\Models;
use App\Models\BaseModel;

/**
 *
 */
class CourseTypesModel extends BaseModel
{

  protected $table = 'course_types';

  protected $allowedFields = ['id', 'type', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

}
