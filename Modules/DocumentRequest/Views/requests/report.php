<br>
<h1>Total: <?=esc(count($documents))?></h1>
<br>
<h2><?=esc($document)?> -  (<?=esc(ucwords($types['t']))?> | <?=esc($types['a'])?>)</h2>
<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="20%"> <b>Name</b> </td>
    <td width="15%"> <b>Status</b> </td>
    <td width="10%"> <b>Year Gaduated</b> </td>
    <td width="10%"> <b>Date Admission</b> </td>
    <td width="10%"> <b>Course</b> </td>
    <td width="10%"> <b>Date Requested</b> </td>
    <td width="10%"> <b>Date Printed</b> </td>
    <td width="10%"> <b>Date Received</b> </td>
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
        <td style="text-transform: uppercase;"> <?=ucwords(esc($document['firstname']). ' ' . esc($document['lastname']) . ' ' . esc($request['suffix']))?> </td>
        <td> <?=ucwords($document['student_status'])?> </td>
        <td> <?=$document['year_graduated'] != null ? $document['year_graduated'] : 'N/A'?> </td>
        <td> <?=substr($document['student_number'], 0,4)?> </td>
        <td> <?=$document['abbreviation'] . ' ' . $document['level']?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['requested_at'])))?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['printed_at'])))?> </td>
        <td> <?=date('M d, Y', strtotime(esc($document['received_at'])))?> </td>
        </tr>
      <?php $ctr++; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
