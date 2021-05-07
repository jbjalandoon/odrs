<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <span class="h2">Documents</span>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
            <thead>
              <tr>
                <th>Document</th>
                <th>Price</th>
                <th>Office Clearance</th>
                <th>Notes</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $document): ?>
                  <tr>
                  <td><?=ucwords(esc($document['document']))?></td>
                  <td>P <?=ucwords(esc($document['price']))?></td>
                  <td>
                    <ul>
                      <?php $ctr = 0; ?>
                      <?php foreach ($document_requirements as $document_requirement): ?>
                        <?php if ($document_requirement['document_id'] == $document['id']): ?>
                          <?php $ctr++ ?>
                          <li><?=$document_requirement['office']?></li>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                    <?php if ($ctr == 0): ?>
                      No Office Requirements
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php $notes = explode(',', esc($document['note'])); ?>
                    <ul>
                      <?php foreach ($notes as $key => $value): ?>
                        <li><?=ucfirst(esc($value))?></li>
                      <?php endforeach; ?>
                    </ul>
                  </td>
                  <td>
                    <a href="#" class="btn btn-sm btn-edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a href="#" class="btn btn-sm btn-delete"><i class="fas fa-archive"></i> Archive</a>
                  </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
