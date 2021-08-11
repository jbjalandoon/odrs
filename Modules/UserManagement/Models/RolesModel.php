<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class RolesModel extends BaseModel
{

  protected $table = 'roles';

  protected $allowedFields = ['id','landing_page', 'identifier','role', 'description', 'deleted_at'];

}
