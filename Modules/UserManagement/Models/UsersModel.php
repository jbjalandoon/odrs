<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class UsersModel extends BaseModel
{

  protected $table = 'users';

  protected $allowedFields = ['id', 'username', 'password', 'email', 'status', 'role_id', 'token'];

  function __construct()
  {
    parent::__construct();
  }

  public function getUserByStatus($status, $role){
    $this->select('users.id, users.username, users.email, users.status, roles.role');
    $this->join('roles', 'roles.id = users.role_id');
    $this->where('status', $status);
    if($role != null){
      $this->where('role_id', $role);
    }
    return $this->findAll();
  }

  public function getUsername($username){
    $this->where('username', $username);
    return $this->findAll();
  }

}
