<table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
  <thead>
    <tr>
      <th>Name</th>
      <th>Course</th>
      <th>Document</th>
      <th>Reason</th>
      <th>Date Requested</th>
      <th>Date Printed</th>
      <th>Proess Time</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($request_details as $request_detail): ?>
      <tr>
        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']) . ' ' . esc($request_detail['suffix']))?></td>
        <td><?=ucwords(esc($request_detail['abbreviation']))?></td>
        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['document']))?></td>
        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['reason']))?></td>
        <td><?=date('M d, y - H:i A', strtotime(esc($request_detail['confirmed_at'])))?></td>
        <td><?=date('M d, y - H:i A', strtotime(esc($request_detail['printed_at'])))?></td>
        <td>
          <?php $date1 = strtotime(esc($request_detail['confirmed_at'])) ?>
          <?php $date2 = strtotime(esc($request_detail['printed_at'])) ?>
          <?php
            $diff = abs($date2 - $date1);
            $years = floor($diff / (365*60*60*24));
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
            $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
            $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
          ?>
          <?php printf("%d days, %d hours, ". "%d minutes",$days, $hours, $minutes)?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
