<?php

namespace Modules\UserManagement\Models;
use App\Models\BaseModel;
use Modules\StudentManagement\Models\StudentsModel;
use Modules\StudentManagement\Controllers\Students;
// use Modules\UserManagement\Models\AdminsModel;

/**
 *
 */
class UsersModel extends BaseModel
{

  protected $table = 'users';

  protected $allowedFields = ['id', 'username', 'password', 'email', 'status', 'office_id','role_id', 'token','deleted_at'];

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
    $data['token'] = md5($_POST['password']);

    $this->insert($data);
    $data['user_id'] = $this->getInsertID();

    $admin = new AdminsModel();
    $admin->insert($data);

    $this->transComplete();
    return $this->transStatus();
  }

  public function editDetails($id, $data)
  {

    $this->transStart();

    if ($data['password'] == '') {
      unset($data['password']);
    }
    // die($id);

    $this->edit($data, $id);
    $admin = new AdminsModel();
    $admin->editByUserId($data, $id);

    $this->transComplete();
    return $this->transStatus();
  }

  public function getUsername($username){
    $this->select('users.*, roles.role, roles.identifier, roles.landing_page');
    $this->join('roles', 'roles.id = users.role_id');
    $this->where('username', $username);
    $this->orWhere('email', $username);
    return $this->findAll();
  }

  public function inputDetailBulk($data){

    $student = new Students();
    $this->transBegin();
    foreach($data as $key => $value)
    {
      $password = random_string('alnum', 8);
      $userData = [
        'username' => $data[$key]['student_number'],
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'email' =>  $data[$key]['email'],
        'token' => null,
        'role_id' => 4
      ];
        $this->insert($userData);
        $data[$key]['user_id'] = $this->getInsertID();

        $StudentsModel = new StudentsModel();
        $StudentsModel->insert($data[$key]);

        if(!$student->sendPassword($data[$key]['student_number'] ,$password, $data[$key]['email']))
        {
          $this->transRollback();
          return false;
        }
    }
    $this->transCommit();
    return true;

  }

  public function getCount($username, $email){
    $this->where('username', $username);
    $this->orWhere('email', $email);
    return $this->countAllResults();
  }

}
