<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class RolePermissionsModel extends BaseModel
{

  protected $table = 'role_permissions';

  protected $allowedFields = ['role_id', 'permission_id', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = []){

    $this->select('role_permissions.*, roles.role, permissions.permission, permission_types.type, modules.id as module_id, permission_types.id as type_id');
    $this->join('roles', 'roles.id = role_permissions.role_id');
    $this->join('permissions', 'permissions.id = role_permissions.permission_id');
    $this->join('permission_types', 'permission_types.id = permissions.permission_type');
    $this->join('modules', 'modules.id = permissions.module_id');
    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }
    return $this->findAll();
  }

  public function getModules($conditions = []){
    $this->select('modules.module, modules.id');
    $this->join('permissions', 'permissions.id = role_permissions.permission_id');
    $this->join('modules', 'modules.id = permissions.module_id');
    $this->groupBy('permissions.module_id');
    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }
    return $this->findAll();
  }

  public function getTypes($conditions = []){
    $this->select('permission_types.type, permission_types.id');
    $this->join('permissions', 'permissions.id = role_permissions.permission_id');
    $this->join('permission_types', 'permission_types.id = permissions.permission_type');
    $this->groupBy('permission_types.slug');
    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }
    return $this->findAll();
  }

  public function softDeleteByRoleId($id){
    return $this->where('role_id', $id)->delete();
  }
  public function EditByModuleId($data, $id){
    return $this->update(['module_id' => $id], $data);
  }

}
