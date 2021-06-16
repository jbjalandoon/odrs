<h4 style="text-align:center">Claiming Stub</h4>
<?php foreach ($requests as $request): ?>
  <table cellpadding="5">
    <tr>
      <td><b>Name: </b> <?=ucwords(esc($request['firstname']) . ' ' . esc($request['middlename'][0]) . '. ' . esc($request['lastname']))?></td>
      <td><b>Student Number: </b> <?=esc($request['student_number'])?></td>
    </tr>
    <tr>
      <td><b>Date Requested: </b> <?=date('F d, Y h:i A', strtotime(esc($request['created_at'])))?></td>
    </tr>
  </table>
  <br>
<?php endforeach; ?>
<h3>Document/s Requested:</h3>
<table cellpadding="5" border="1">
  <tr style="text-align:center">
    <th width="7%">Qty</th>
    <th width="25%">Document</th>
    <th width="30%">Notes</th>
    <th width="25%">Clearance</th>
    <th width="13%">Price</th>
  </tr>
  <?php $price = 0; ?>
    <?php foreach ($request_documents as $request_detail): ?>
      <tr style="text-align:center">
        <td><?=esc($request_detail['quantity'])?></td>
        <td><?=esc($request_detail['document'])?> </td>
        <td>
          <ul>
            <li><?=ucfirst(esc($request_detail['note']))?></li>
          </ul>
        </td>
          <?php if (!empty($request_approvals)): ?>
            <?php foreach ($request_approvals as $request_approval): ?>
              <?php if ($request_approval['document_id'] == $request_detail['document_id']): ?>
                  <td><?=$request_approval['office']?>:
                  <?=$request_approval['status'] == 'a' ? 'Approved': 'Pending'?></td>
                <?php else: ?>
                  <td>N/A</td>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <td>
            P <?=esc($request_detail['price'])?>
          </td>
      </tr>
      <?php $price += $request_detail['price']; ?>
    <?php endforeach; ?>

  </table>
  <table border="0">
    <tr border="0">
      <td colspan="4" width="87%"  style="text-align:right">Total price: </td>
      <td colspan="1" width="13%" style="text-align:center">P <?=$price?></td>
    </tr>
  </table>
