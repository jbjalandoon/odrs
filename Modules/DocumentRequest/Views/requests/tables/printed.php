<table class="table table-data mt-3" id="processed-table" style="width:100%">
  <thead>
    <tr>
      <th>Bar Code</th>
      <th>Name</th>
      <th>Course</th>
      <th>Document</th>
      <th>Date Requested</th>
      <th>Date Printed</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($request_details_release as $request_detail): ?>
      <tr>
        <td><?=esc($request_detail['slug'])?></td>
        <td><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']) . ' ' . esc($request_detail['suffix']))?></td>
        <td><?=ucwords(esc($request_detail['course']))?></td>
        <td><?=ucwords(esc($request_detail['document']))?></td>
        <td><?=date('F d, Y', strtotime(esc($request_detail['confirmed_at'])))?></td>
        <td><?=date('F d, Y', strtotime(esc($request_detail['printed_at'])))?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
