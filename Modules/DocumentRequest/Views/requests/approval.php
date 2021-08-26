<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-approval-tab" data-bs-toggle="tab" data-bs-target="#nav-approval" type="button" role="tab" aria-controls="nav-approval" aria-selected="true">For Approval</button>
              <button class="nav-link" id="nav-hold-tab" data-bs-toggle="tab" data-bs-target="#nav-hold" type="button" role="tab" aria-controls="nav-hold" aria-selected="false">On Hold Requests</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-approval" role="tabpanel" aria-labelledby="nav-approval-tab">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id="approval-table" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>request detail id</th>
                          <th>Student Number</th>
                          <th>Name</th>
                          <th>Course</th>
                          <th>Document</th>
                          <th>Date Requested</th>
                          <th>Action</tH>
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
                            <td><?=esc($request_approval['document'])?></td>
                            <td><?=date('M d, Y', strtotime(esc($request_approval['created_at'])))?></td>
                            <td>
                              <button onclick="holdRequest(<?=esc($request_approval['id'])?>, '<?=esc($request_approval['student_number'])?>', <?=esc($request_approval['request_detail_id'])?>)" class="btn btn-reject btn-sm"> Hold </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-hold" role="tabpanel" aria-labelledby="nav-hold-tab">
              <div class="table-responsive">
                <table id="on-hold-table" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>request detail id</th>
                      <th>Student Number</th>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Document</th>
                      <th>Remark</th>
                      <th>Date Requested</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($request_approvals_hold as $request_approval): ?>
                      <tr>
                        <td><?=esc($request_approval['id'])?></td>
                        <td><?=esc($request_approval['request_detail_id'])?></td>
                        <td><?=esc($request_approval['student_number'])?></td>
                        <td><?=ucwords(esc($request_approval['firstname']) . ' ' . esc($request_approval['lastname']) . ' ' . esc($request['suffix']))?></td>
                        <td><?=esc($request_approval['course'])?></td>
                        <td><?=esc($request_approval['document'])?></td>
                        <td><?=esc($request_approval['remark'])?></td>
                        <td><?=date('M d, Y', strtotime(esc($request_approval['created_at'])))?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>                      
      </div>
    </div>
  </div>
</div>