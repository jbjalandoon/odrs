<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class ModulesModel extends BaseModel
{

  protected $table = 'modules';

  protected $allowedFields = ['slug', 'module'];

  function __construct(){
    parent::__construct();
  }

}
