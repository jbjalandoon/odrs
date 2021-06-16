<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Office Approval</li>
            </ol>
          </nav>
          <hr>
          <div class="tab">
            <button class="tablinks" onclick="opentab(event, 'forApproval')" onload="click()" id="defaultOpen">For Approval</button>
            <button class="tablinks" onclick="opentab(event, 'onHold')">On Hold</button>
          </div>
          <div id="forApproval" class="tabcontent">
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
                      <button onclick="holdRequest(<?=esc($request_approval['id'])?>, '<?=esc($request_approval['student_number'])?>', <?=esc($request_approval['request_detail_id'])?>)" class="btn btn-danger btn-sm"> Hold </button?
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div id="onHold" class="tabcontent">
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
                    <td><?=ucwords(esc($request_approval['firstname']) . ' ' . esc($request_approval['lastname']))?></td>
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