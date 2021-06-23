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
      <th>Action</th>
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
        <td>
          <button type="button" onClick="printRequest(<?=$request_detail['id']?>, <?=$request_detail['per_page_payment']?>, <?=$request_detail['template'] == null ? 'null': "'".$request_detail['template']."'"?>)" class="btn btn-primary" name="button">Complete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
