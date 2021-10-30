<section class="content">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="admin-form-table" class="table table-striped table-bordered dataTables" style="width:100%">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Course</th>
              <th>School</th>
              <th>School Address</th>
              <th>Remarks</th>
              <th>Status</th>
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
                  <td><?=esc($request['abbreviation'])?></td>
                  <td><?=esc($request['school'])?></td>
                  <td><?=esc($request['address'])?></td>
                  <td><?=esc($request['remarks'])?></td>
                  <td>
                    <?php if (esc($request['status']) == 'w'): ?>
                      Waiting for Approval
                    <?php elseif(esc($request['status']) == 'o'): ?>
                      On Process
                    <?php else: ?>
                      Completed
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if (esc($request['status']) == 'w'): ?>
                      <button onClick="acceptForm(<?=esc($request['id'])?>, '<?=esc($request['student_number'])?>')" class="btn btn-reject btn-success btn-sm"> Accept </button>
                    <?php elseif(esc($request['status']) == 'o'): ?>
                      <button onClick="receiveForm(<?=esc($request['id'])?>, '<?=esc($request['student_number'])?>')" class="btn btn-reject btn-success btn-sm"> Receive </button>
                    <?php else: ?>
                      N/A
                    <?php endif; ?>
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
