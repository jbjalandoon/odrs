<div class="card me-3 mt-5">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2">Claimed Request</span>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-bordered mt-3 data-table" style="width:100%">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Document</th>
                <th>Reason</th>
                <th>Date Requested</th>
                <th>Date Received</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($request_details as $request_detail): ?>
                <tr>
                  <td><?=esc($request_detail['student_number'])?></td>
                  <td><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']))?></td>
                  <td><?=ucwords(esc($request_detail['course']))?></td>
                  <td><?=ucwords(esc($request_detail['document']))?></td>
                  <td><?=ucwords(esc($request_detail['reason']))?></td>
                  <td><?=date('F d, Y - H:i A', strtotime(esc($request_detail['requested_at'])))?></td>
                  <td><?=date('F d, Y - H:i A', strtotime(esc($request_detail['received_at'])))?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
