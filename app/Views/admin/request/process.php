<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12">
          <table id="process-table" class="table table-striped table-bordered mt-3" style="width:100%">
            <thead>
              <tr>
                <th>id</th>
                <th>request_id</th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Document</th>
                <th>Date Requested</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($request_details as $request_detail): ?>
                <tr>
                  <td><?=esc($request_detail['id'])?></td>
                  <td><?=esc($request_detail['request_id'])?></td>
                  <td><?=esc($request_detail['student_number'])?></td>
                  <td><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']))?></td>
                  <td><?=ucwords(esc($request_detail['course']))?></td>
                  <td><?=ucwords(esc($request_detail['document']))?></td>
                  <td><?=date('F d, Y - H:i A', strtotime(esc($request_detail['requested_at'])))?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
