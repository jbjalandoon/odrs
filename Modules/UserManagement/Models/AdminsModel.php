<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class AdminsModel extends BaseModel
{

  protected $table = 'admins';

  protected $allowedFields = ['id', 'firstname', 'lastname', 'middlename', 'contact', 'user_id'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [])
  {
    $this->select('admins.*, users.email, roles.role, roles.identifier');
    $this->join('users', 'users.id = admins.user_id');
    $this->join('roles', 'roles.id = users.role_id');

    foreach ($conditions as $condition => $value) {
      $this->where($condition , $value);
    }

    return $this->findAll();
  }

  public function getAdminByUserId($id){
    $this->where('user_id', $id);
    return $this->findAll();
  }

}
