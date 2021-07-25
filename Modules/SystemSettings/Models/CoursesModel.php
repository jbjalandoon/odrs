<?php

namespace Modules\SystemSettings\Models;
use App\Models\BaseModel;

/**
 *
 */
class CoursesModel extends BaseModel
{

  protected $table = 'courses';

  protected $allowedFields = ['id', 'course', 'course_type','abbreviation'];

  public function getDetails($conditions = [])
  {
    $this->select('courses.*, course_types.type');
    $this->join('course_types', 'course_types.id = courses.course_type');
    foreach($conditions as $key => $value)
    {
      $this->where($key, $value);
    }
    return $this->findAll();
  }

  public function getCourseId(){
    $this->select('id, course');
    return $this->findAll();
  }

}
