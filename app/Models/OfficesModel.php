<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class OfficesModel extends BaseModel
{

  protected $table = 'offices';

  protected $allowedFields = ['id', 'office'];

  function __construct(){
    parent::__construct();
  }

}
