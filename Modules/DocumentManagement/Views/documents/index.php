<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=esc($_SESSION['success_message'])?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-3">
        <div class="col-2">
          <span class="h2">Documents</span>
        </div>
        <div class="col-10">
          <?=esc(buttons($allPermissions, ['add-document'], 'documents'))?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Document</th>
                  <th>Price</th>
                  <th>Template</th>
                  <th>Per Page Payment</th>
                  <th>Free on first Request</th>
                  <th>Notes</th>
                  <th>Office Requirements</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($documents)): ?>
                  <?php foreach ($documents as $document): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($document['document']))?></td>
                      <td><?=ucfirst('P '.esc($document['price']))?></td>
                      <td><?=esc($document['template'] == null ? 'N/A': $document['template'])?></td>
                      <td><?=esc($document['per_page_payment']) ? 'Yes': 'No'?></td>
                      <td><?=esc($document['is_free_on_first']) ? 'Yes': 'No'?></td>
                      <td class="document-notes" id="<?=esc($document['id'])?>">
                        Notes
                      </td>
                      <td class="document-requirements" id="<?=esc($document['id'])?>">
                        Office Requirements
                      </td>
                      <td class="text-center">
                        <?=esc(buttons($allPermissions, ['edit-document', 'delete-document'], 'documents', $document['id']))?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
