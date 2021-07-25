<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Document</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($id) : 'add'?>" method="post" autocomplete="off">
      <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="document" class="form-label">Document</label>
              <input value="<?=isset($value['document']) ? esc($value['document']): ''?>" type="text" name="document" class="form-control" id="document">
              <?php if (isset($error['document'])): ?>
                <div class="text-danger">
                  <?=esc($error['document'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="price" class="form-label">Price</label>
              <input value="<?=isset($value['price']) ? esc($value['price']): ''?>" type="text" name="price" class="form-control" id="price">
              <?php if (isset($error['price'])): ?>
                <div class="text-danger">
                  <?=esc($error['price'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="template" class="form-label">Template</label>
              <input value="<?=isset($value['template']) ? esc($value['template']): ''?>" type="text" name="template" class="form-control" id="template">
              <?php if (isset($error['template'])): ?>
                <div class="text-danger">
                  <?=esc($error['template'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="note_id" class="form-label" >Document Notes</label>
              <br>
              <select class="documents-tag form-control" name="note_id[]" multiple="multiple" id="note_id">
                <?php foreach ($notes as $note): ?>
                  <?php $selected = false; ?>
                  <?php if (!empty($document_notes)): ?>
                    <?php foreach ($document_notes as $document_note): ?>
                      <?php if ($document_note['note_id'] == $note['id']): ?>
                        <?php $selected = true; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <option value="<?=esc($note['id'])?>" <?=$selected ? 'selected': ''?>><?=ucwords(esc($note['note']))?></option>
                <?php endforeach; ?>
              </select>
              <?php if (isset($error['note_id'])): ?>
                <div class="text-danger">
                  <?=esc($error['note_id'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="office_id" class="form-label" >Document Office Requirements</label>
              <br>
              <select class="js-example-responsive form-control" name="office_id[]" multiple="multiple" id="office_id">
                <?php foreach ($offices as $office): ?>
                  <?php $selected = false; ?>
                  <?php if (!empty($document_requirements)): ?>
                    <?php foreach ($document_requirements as $document_requirement): ?>
                      <?php if ($document_requirement['office_id'] == $office['id']): ?>
                        <?php $selected = true; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <option value="<?=esc($office['id'])?>" <?=$selected ? 'selected': ''?>><?=ucwords(esc($office['office']))?></option>
                <?php endforeach; ?>
              </select>
              <?php if (isset($office['office_id'])): ?>
                <div class="text-danger">
                  <?=esc($office['office_id'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="">Free on first Request</label>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_free_on_first" id="inlineRadio1" value="1" checked>
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_free_on_first" id="inlineRadio2" value="0" <?=isset($value['is_free_on_first']) && !$value['is_free_on_first'] ? 'checked': ''?>>
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
              <?php if (isset($error['is_free_on_first'])): ?>
                <div class="text-danger">
                  <?=esc($error['is_free_on_first'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="">Per Page Payment</label>
              <br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="per_page_payment" id="inlineRadio3" value="1" checked>
                <label class="form-check-label" for="inlineRadio3">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="per_page_payment" id="inlineRadio4" value="0" <?=isset($value['per_page_payment']) && !$value['per_page_payment'] ? 'checked': ''?>>
                <label class="form-check-label" for="inlineRadio4">No</label>
              </div>
              <?php if (isset($error['per_page_payment'])): ?>
                <div class="text-danger">
                  <?=esc($error['per_page_payment'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="float-end btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
