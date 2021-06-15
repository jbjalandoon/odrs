<?php

namespace App\Models;
use App\Models\BaseModel;

/**
 *
 */
class DocumentsModel extends BaseModel
{

  protected $table = 'documents';

  protected $allowedFields = ['id', 'document', 'price', 'note'];

  function __construct(){
    parent::__construct();
  }

}
