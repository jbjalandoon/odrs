    <section class="content">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="admin-payment-table" class="table table-striped table-bordered dataTables" style="width:100%">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Course</th>
                  <th>Reason</th>
                  <th>Documents</th>
                  <th>Date Approved</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($requests)): ?>
                  <?php foreach ($requests as $request): ?>
                    <tr class="active-row">
                      <td><?=esc($request['id'])?></td>
                      <!-- <td><input  id="row" type="checkbox"></td> -->
                      <td style="text-transform: uppercase;"><?= ucwords(esc($request['firstname']) . ' ' . esc($request['lastname']) . ' ' . esc($request['suffix'])) ?></td>
                      <td><?= ucwords(esc($request['student_status'])) ?></td>
                      <td><?=esc($request['abbreviation'])?></td>
                      <td><?=strtoupper(esc($request['reason']))?></td>
                      <td>
                        <ul>
                          <?php foreach ($request_documents as $request_document): ?>
                            <?php if (esc($request_document['request_id']) == esc($request['id'])): ?>
                              <li><?=' ( '  . esc($request_document['quantity']) . ' ) ' .esc($request_document['document']) ?></li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </ul>
                      </td>
                      <td><?= date('F d, Y - H:i A', strtotime(esc($request['approved_at']))) ?></td>
                      <td>
                        <button onClick="acceptRequest(<?=esc($request['id'])?>, '<?=esc($request['student_number'])?>')" class="btn btn-reject btn-success btn-sm"> Start Processing </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
