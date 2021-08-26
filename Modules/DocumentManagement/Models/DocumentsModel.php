<?php

namespace Modules\DocumentManagement\Models;
use App\Models\BaseModel;

/**
 *
 */
class DocumentsModel extends BaseModel
{

  protected $table = 'documents';

  protected $allowedFields = ['id', 'document', 'price', 'is_free_on_first', 'process_day','template','per_page_payment', 'deleted_at'];

  function __construct(){
    parent::__construct();
  }

  public function insertDocument($data)
  {
    $this->transStart();

    $this->insert($data);
    $id = $this->getInsertID();

    $notes = new  NotesModel();
    $documentNotes = new  DocumentNotesModel();
    $office = new DocumentRequirementsModel();
    if(!empty($data['note_id'])){
      foreach($data['note_id'] as $key => $value)
      {
        if(empty($notes->get(['id' => $value])))
        {
          $note = $notes->input(['note' => $value], 'id');
        } else {
          $note = $value;
        }
        $documentNotes->input(['document_id' => $id, 'note_id' => $note]);
      }
    }
    if(!empty($data['office_id']))
    {
      foreach($data['office_id'] as $key => $value)
      {
        $office->input(['document_id' => $id, 'office_id' => $value]);
      }
    }

    $this->transComplete();

    return $this->transStatus();
  }

  public function editDocument($data, $id)
  {
    $this->transStart();

    $this->update($id, $data);

    $notes = new  NotesModel();
    $documentNotes = new  DocumentNotesModel();
    $office = new DocumentRequirementsModel();
    $documentNotes->where('document_id', $id)->delete();
    $office->where('document_id', $id)->delete();
    if(!empty($data['note_id'])){
      foreach($data['note_id'] as $key => $value)
      {
        $doucmentNotesList = $documentNotes->get(['document_id' => $id, 'note_id' => $value]);
        if (!empty($doucmentNotesList)) {
          $documentNoteModel->update(['note_id' => $value], ['deleted_at' => null]);
        } else {
          if(empty($notes->get(['id' => $value])))
          {
            $note = $notes->input(['note' => $value], 'id');
          } else {
            $note = $value;
          }
          $documentNotes->input(['document_id' => $id, 'note_id' => $note]);
        }
      }
    }
    if(!empty($data['office_id']))
    {
      foreach($data['office_id'] as $key => $value)
      {
        $officeList = $office->get(['document_id' => $id, 'office_id' => $value]);
        if (!empty($officeList)) {
          $documentRequirementModel->update(['office_id' => $value], ['deleted_at' => null]);
        } else {
          $office->input(['document_id' => $id, 'office_id' => $value]);
        }
      }
    }

    $this->transComplete();

    return $this->transStatus();
  }

}
