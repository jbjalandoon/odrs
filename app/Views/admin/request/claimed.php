<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2">Claimed Request</span>
          <button class="float-end btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Generate Report
          </button>
        </div>
      </div>
      <div class="row mb-3">
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            <form  action="request/report" method="get">
              <div class="row mb-3">
                <div class="col-4">
                  <label for="document" class="form-label">Document</label>
                  <select id="document" class="form-select" name="d">
                    <?php if (!empty($documents)): ?>
                      <?php foreach ($documents as $document): ?>
                        <option value="<?=esc($document['id'])?>"><?=ucwords(esc($document['document']))?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
                <div class="col-4">
                  <label  for="type" class="form-label">Type</label>
                  <select id="type" class="form-select" name="t">
                    <option value="yearly">Yearly</option>
                    <option value="monthly">Monthy</option>
                    <option value="daily">Daily</option>
                  </select>
                </div>
                <div class="col-4">
                  <label for="argument" class="form-label"> # </label>
                  <input type="year" id="argument" class="form-control" name="a" required>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="float-end btn btn-primary" formtarget="_blank"> Generate </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="btn-group" role="group" aria-label="document">
              <button type="button" onClick="filter(0)" class="btn btn-secondary me-1"> All </button>
            <?php foreach ($documents as $document): ?>
              <button onClick="filter(<?=esc($document['id'])?>)" type="button" class="btn btn-secondary me-1"><?=ucwords(esc($document['document']))?></button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-bordered mt-3 dataTables" style="width:100%">
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
