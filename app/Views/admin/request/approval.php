<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12">
          <table id="approval-table" class="table table-striped table-bordered dataTables" style="width:100%">
            <thead>
              <tr>
                <th>id</th>
                <th>request detail id</th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <?= isset($office_id) ? '' : '<th>Office</th>'?>
                <th>Document</th>
                <th>Date Requested</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($request_approvals as $request_approval): ?>
                <tr>
                  <td><?=esc($request_approval['id'])?></td>
                  <td><?=esc($request_approval['request_detail_id'])?></td>
                  <td><?=esc($request_approval['student_number'])?></td>
                  <td><?=ucwords(esc($request_approval['firstname']) . ' ' . esc($request_approval['lastname']))?></td>
                  <td><?=esc($request_approval['course'])?></td>
                  <td><?=esc($request_approval['office'])?></td>
                  <td><?=esc($request_approval['document'])?></td>
                  <td><?=esc($request_approval['created_at'])?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
