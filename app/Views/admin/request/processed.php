<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12 mb-3">
          <h2>Ready to claim document</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-6 offset-3">
          <form class="" action="<?=base_url()?>/admin/scan" method="post">
            <div class="form-floating">
              <input type="text" class="form-control mb-3" name="slugs" class="floatingInput" placeholder="Student Number" required>
              <label for="floatingInput">Scan Barcode here for claiming</label>
            </div>
            <?php if (isset($_SESSION['success_message'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php foreach ($_SESSION['success_message'] as $request_detail): ?>
                  <?php if ($request_detail['status']= 'c'): ?>
                    <?=$request_detail['document']?> - Received
                  <?php else: ?>
                    <?=$request_detail['document']?> - On Process
                  <?php endif; ?>
                  <br>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_message'])): ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?=$_SESSION['error_message']?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
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
