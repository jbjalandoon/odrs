<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class CoursesModel extends BaseModel
{

  protected $table = 'courses';

  protected $allowedFields = ['id', 'course', 'abbreviation'];

}
