<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <table id="admin-pending-table" class="table table-striped table-bordered dataTables" style="width:100%">
            <thead>
              <tr>
                <th>id</th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th> 
                <th>Reason</th>
                <th>Documents</th>
                <th>Date Requested</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($requests)): ?>
                <?php foreach ($requests as $request): ?>
                  <tr class="active-row">
                    <td><?=esc($request['id'])?></td>
                    <!-- <td><input  id="row" type="checkbox"></td> -->
                    <td><?= esc($request['student_number']) ?></td>
                    <td><?= ucwords(esc($request['firstname']) . ' ' . esc($request['lastname'])) ?></td>
                    <td><?=esc($request['abbreviation'])?></td>
                    <td><?=esc($request['reason'])?></td>
                    <td>
                      <ul>
                        <?php foreach ($request_documents as $request_document): ?>
                          <?php if (esc($request_document['request_id']) == esc($request['id'])): ?>
                            <li><?=' ( '  . esc($request_document['quantity']) . ' ) ' .esc($request_document['document']) ?></li>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                    </td>
                    <td><?= date('F d, Y - H:i A', strtotime(esc($request['created_at']))) ?></td>
                    <td>
                      <button onClick="denyRequest(<?=esc($request['id'])?>, '<?=esc($request['student_number'])?>')" class="btn btn-reject btn-danger"> Reject </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>                      
      </div>
    </div>
  </div>
</div>
