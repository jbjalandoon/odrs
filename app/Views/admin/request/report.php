<br>
<h2>Document Report</h2>
<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="20%"> <b>Student Number</b> </td>
    <td width="15%"> <b>Name</b> </td>
    <td width="15%"> <b>Document</b> </td>
    <td width="15%"> <b>Date Requested</b> </td>
    <td width="15%"> <b>Date Printed</b> </td>
    <td width="15%"> <b>Date Received</b> </td>
  </tr>
  <?php if (empty($documents)): ?>
    <tr>
      <td colspan="7" style="text-align: center;"> No Available Data </td>
    </tr>
  <?php else: ?>
    <?php $ctr = 1; ?>
    <?php foreach ($documents as $document): ?>
      <tr style="text-align: center;">
        <td> <?=$ctr?> </td>
        <td> <?=esc($document['student_number'])?> </td>
        <td> <?=ucwords(esc($document['firstname']). ' ' . esc($document['lastname']))?> </td>
        <td> <?=ucwords(esc($document['document']))?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['requested_at'])))?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['printed_at'])))?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['received_at'])))?> </td>
        </tr>
      <?php $ctr++; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
