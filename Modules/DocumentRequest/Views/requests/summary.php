<br>
<h1>Summary Report</h1>
<br>
<h2><?=esc($document)?> -  (<?=esc(ucwords($types['t']))?> | <?=date('F', mktime(0, 0, 0, (int)esc($types['a']), 10));?>)</h2>
<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="20%"> <b># of Students</b> </td>
    <td width="20%"> <b>Estimated Number of Days to Proess</b> </td>
    <td width="20%"> <b>Date Requested</b> </td>
    <td width="20%"> <b>Date Printed</b> </td>
    <td width="20%"> <b>Remark</b> </td>
  </tr>
  <?php if (empty($documents)): ?>
    <tr>
      <td colspan="7" style="text-align: center;"> No Available Data </td>
    </tr>
  <?php else: ?>
    <?php $total = 0; ?>
    <?php foreach ($documents as $document): ?>
      <tr style="text-align: center;">
        <td> <?= $document['count'] ?> </td>
        <td>
          <?php
          $dtF = new \DateTime('@0');
          $dtT = new \DateTime('@'.$document['process_day']);
          echo $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
          ?>
        </td>
        <td> <?=date('F d, Y', strtotime($document['confirmed_at']))?> </td>
        <td> <?=date('F d, Y', strtotime($document['printed_at']))?> </td>
        <td> Within the Day </td>
      </tr>
      <?php $total += $document['count'] ?>
    <?php endforeach; ?>
    <tr>
      <td align="right"><b><?=$total?></b></td>
      <td align="left"><b>Total</b></td>
      <td colspan="3" align="right"><b>Average Acted Upon Before the Deadline: Within the day = 5.0</b></td>
    </tr>
  <?php endif; ?>
</table>
