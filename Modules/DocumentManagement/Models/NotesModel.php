<?php

namespace Modules\DocumentManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class NotesModel extends BaseModel
{

  protected $table = 'notes';

  protected $allowedFields = ['note', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

}
