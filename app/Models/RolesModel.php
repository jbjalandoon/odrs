<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class RolesModel extends BaseModel
{

  protected $table = 'roles';

  protected $allowedFields = ['id', 'role', 'description', 'deleted_at'];

}
