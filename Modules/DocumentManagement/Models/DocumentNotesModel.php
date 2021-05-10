<?php

namespace Modules\DocumentManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class DocumentNotesModel extends BaseModel
{

  protected $table = 'document_notes';

  protected $allowedFields = ['note_id', 'document_id','deleted_at'];

  
  function __construct(){
    parent::__construct();
  }

  public function getDetails($conditions = [])
  {
    $this->select('document_notes.*, notes.note');

    $this->join('notes', 'document_notes.note_id = notes.id');

    foreach($conditions as $key => $value)
    {
      $this->where($key, $value);
    }

    return $this->findAll();
  }

}
