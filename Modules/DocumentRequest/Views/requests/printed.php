<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
      <div class="form-floating">
        <input type="text" class="form-control mb-3"onEnter="scan()" name="slug" id="slug" class="floatingInput" placeholder="Student Number" required>
        <label for="floatingInput"></label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-data mt-3 dataTable" id="processed-table" style="width:100%">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Document</th>
                <th>Date Requested</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($request_details_release as $request_detail): ?>
                <tr>
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