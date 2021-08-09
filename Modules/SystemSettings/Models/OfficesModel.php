<?php

namespace Modules\SystemSettings\Models;
use App\Models\BaseModel;

/**
 *
 */
class OfficesModel extends BaseModel
{

  protected $table = 'offices';

  protected $allowedFields = ['id', 'office','deleted_at'];

  function __construct(){
    parent::__construct();
  }

}
