<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class AdminsModel extends BaseModel
{

  protected $table = 'admins';

  protected $allowedFields = ['id', 'firstname', 'lastname', 'middlename', 'contact', 'user_id','deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [])
  {
    $this->select('admins.*, users.email, roles.role, roles.identifier, users.id as user_id, users.username');
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

  public function editByUserId($data, $id){
    $updateData = [
      'firstname' => $data['firstname'],
      'lastname' => $data['lastname'],
      'middlename' => $data['middlename'],
      'contact' => $data['contact'],
    ];
    $this->where('user_id', $id);
    $this->set($updateData);
    return $this->update();
  }

  public function softDeleteByUserId($id){
    $this->where('user_id', $id);
    return $this->delete();
  }

  public function restoreByUserId($id){
    $this->where('user_id', $id);
    $this->set('deleted_at', null);
    return $this->update();
  }


}
