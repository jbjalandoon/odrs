<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class BaseModel extends Model
{

  protected $deletedField  = 'deleted_at';
  protected $updatedField  = 'updated_at';
  protected $createdField  = 'created_at';
  protected $useSoftDeletes = true;
  protected $useTimestamps  = true;

  function __construct()
  {
    parent::__construct();
  }

  public function get($conditions = []){
    if (!empty($conditions)) {
      foreach ($conditions as $condition => $value) {
        $this->where($condition, $value);
      }
    }
    return $this->findAll();
  }

  public function input($data, $return = null)
  {
    if($return == null){
      return $this->insert($data);
    } else if ($return == 'id') {
      $this->insert($data);
      return $this->insertID();
    } else {
      die('2nd argument is between null and id only');
    }
  }

  public function edit($data, $id)
  {
    return $this->update($id, $data);
  }

  public function softDelete($id)
  {
    return $this->delete($id);
  }

}
