<?php

namespace Modules\ModuleManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class PermissionsModel extends BaseModel
{

  protected $table = 'permissions';

  protected $allowedFields = ['permission', 'slug', 'path','icon', 'description', 'permission_type', 'module_id', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [], $id = null){
    $this->select('permissions.*,  permission_types.type, permission_types.slug as type_slug, modules.module, modules.slug as module_slug');
    $this->join('permission_types', 'permissions.permission_type = permission_types.id');
    $this->join('modules', 'permissions.module_id = modules.id');
    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }
    if ($id != null)
      $this->where('id', $id);
    return $this->findAll();
  }


  public function softDeleteByRoleId($id){
    return $this->where('role_id', $id)->delete();
  }
  public function EditByModuleId($data, $id){
    return $this->update(['module_id' => $id], $data);
  }

}
