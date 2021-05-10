<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;
// use Modules\UserManagement\Models\AdminsModel;

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

  public function inputDetails($data)
  {
    
    $this->transStart();

    $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $this->insert($data);
    $data['user_id'] = $this->getInsertID();

    $admin = new AdminsModel();
    $admin->insert($data);

    $this->transComplete();
    return $this->transStatus();
  }

  public function getUsername($username){
    $this->select('users.*, roles.role, roles.identifier, roles.landing_page');
    $this->join('roles', 'roles.id = users.role_id');
    $this->where('username', $username);
    return $this->findAll();
  }

}
