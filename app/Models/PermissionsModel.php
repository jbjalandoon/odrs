<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class PermissionsModel extends BaseModel
{

  protected $table = 'permissions';

  protected $allowedFields = ['module_id', 'role_id', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [], $id = null){

    $this->select('permissions.*, modules.id as module_id ,modules.module, modules.slug, roles.id as role_id, roles.role');
    $this->join('modules', 'permissions.module_id = modules.id');
    $this->join('roles', 'permissions.role_id = roles.id');
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
