<?php

namespace Modules\ModuleManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class PermissionTypesModel extends BaseModel
{

  protected $table = 'permission_types';

  protected $allowedFields = ['type', 'slug', 'deleted_at'];

  function __construct()
  {
    parent::__construct();
  }

}
