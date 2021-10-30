<br>
<h4 style="text-align:center"> Claiming Stub</h4>
<?php $document_price = 0 ?>
<?php foreach ($requests as $request): ?>
  <table cellpadding="5">
    <tr>
      <td><b>Name: </b> <?=ucwords(esc($request['firstname']) . ' ' . esc($request['middlename']) . '. ' . esc($request['lastname']) . ' ' . esc($request['suffix']))?></td>
      <td><b>Student Number: </b> <?=esc($request['student_number'])?></td>
    </tr>
    <tr>
      <td><b>Date Submitted: </b> <?=date('F d, Y h:i A', strtotime(esc($request['created_at'])))?></td>
    </tr>
  </table>
  <br>
<?php endforeach; ?>
<br>
<br>
<table>
  <tr>
    <th><strong>Date of Release: </strong></th>
    <th><strong>Released by: </strong></th>
  </tr>
</table>
<br>
<br>
<h3>Document/s Requested:</h3>
<table cellpadding="5" border="1">
  <tr style="text-align:center">
    <th width="7%">Qty</th>
    <th width="45%">Document</th>
    <th width="35%">Notes</th>
    <th width="13%">Price</th>
  </tr>
  <?php $price = 0; ?>
    <?php foreach ($request_documents as $request_detail): ?>
      <tr style="text-align:center">
        <td><?=esc($request_detail['quantity'])?></td>
        <td><?=esc($request_detail['document'])?> </td>
        <td>
          <ul>
            <?php if (!empty($document_notes)): ?>
              <?php foreach ($document_notes as $document_note): ?>
                <?php if ($document_note['document_id'] == $request_detail['document_id']): ?>
                  <li><?=esc($document_note['note'])?></li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </td>
        <td>
          P <?php if ($request_detail['per_page_payment']): ?>
            <?php $document_price += $request_detail['free'] ? 0 : $request_detail['price'] * $request_detail['page']?>
            <?=$request_detail['free'] ? '0 (Free)' : esc($request_detail['price'] * $request_detail['page'])?>
            <?php else: ?>
              <?php $document_price += $request_detail['free'] ? 0 : $request_detail['price']?>
              <?=$request_detail['free'] ? '0 (Free)' : esc($request_detail['price'])?>

          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>

  </table>
  <table border="0">
    <tr border="0">
      <td colspan="4" width="87%"  style="text-align:right">Total price: </td>
      <td colspan="1" width="13%" style="text-align:center">P <?=$document_price?></td>
    </tr>
  </table>
