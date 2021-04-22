<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class AdminsModel extends BaseModel
{

  protected $table = 'admins';

  protected $allowedFields = ['id', 'firstname', 'lastname', 'middlename', 'contact', 'user_id', 'office_id'];

  function __construct(){
    parent::__construct();
  }

  public function getAdminByUserId($id){
    $this->where('user_id', $id);
    return $this->findAll();
  }

}
