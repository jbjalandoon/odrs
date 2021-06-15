<?php
namespace Modules\UserManagement\Models;

use CodeIgniter\Model;

class UserDetailsModel extends \CodeIgniter\Model
{
    protected $table = 'user_details';

    protected $allowedFields = ['user_id', 'area_id', 'department_id', 'academic_program_id', 'status', 'created_at','updated_at', 'deleted_at'];

    public function getCredential($id)
  	{
      $db = \Config\Database::connect();

  		$str = "SELECT a.*, b.*, c.area_code, c.area_name, d.department_name, e.program_name FROM users a LEFT JOIN ";
      $str .= "user_details b ON a.id = b.user_id LEFT JOIN areas c ON b.area_id = c.id LEFT JOIN departments d ";
      $str .= "ON b.department_id = d.id LEFT JOIN academic_programs e ON b.academic_program_id = e.id WHERE a.id = ".$id;

  		$query = $db->query($str);
  	  $value =  $query->getResultArray();
  	  return $value[0];
  	}

    public function addUserDetail($val_array = [])
  	{
    		$val_array['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
    		$val_array['status'] = 'a';
  	    return $this->save($val_array);
  	}

    public function editUserDetail($val_array = [], $id)
  	{
  		$val_array['updated_at'] = (new \DateTime())->format('Y-m-d H:i:s');
  		$val_array['status'] = 'a';
  		return $this->update($id, $val_array);
  	}
  //
  //   public function deleteRole($id)
	// {
	// 	$val_array['deleted_at'] = (new \DateTime())->format('Y-m-d H:i:s');
	// 	$val_array['status'] = 'd';
	// 	return $this->update($id, $val_array);
	// }
}
