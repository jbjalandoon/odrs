<div class="container" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <h3>Hello, <?=esc($_SESSION['name'])?>!</h3>
              <p style="font-style: italic; font-size: .9em;">Request for a copy of your academic related documents.</p>
            </div>
            <div class="col-md-4">
              <table class="table request">
                <tbody>
                  <tr>
                    <td>
                      <a href="requests/new" class="btn <?=empty($requests) ? '': 'disabled'?>" disabled><i class="fas fa-plus"></i> Request document here</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr>
          </div>

          <div class="row">
            <div class="col-md-12" id="tab">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-requests-tab" data-bs-toggle="tab" data-bs-target="#nav-requests" type="button" role="tab" aria-controls="nav-requests" aria-selected="true">My Requests</button>
                  <button class="nav-link" id="nav-approval-tab" data-bs-toggle="tab" data-bs-target="#nav-approval" type="button" role="tab" aria-controls="nav-approval" aria-selected="false">For Office Approval</button>
                  <button class="nav-link" id="nav-process-tab" data-bs-toggle="tab" data-bs-target="#nav-process" type="button" role="tab" aria-controls="nav-process" aria-selected="false">On Process Document/s</button>
                  <button class="nav-link" id="nav-released-tab" data-bs-toggle="tab" data-bs-target="#nav-released" type="button" role="tab" aria-controls="nav-released" aria-selected="false">Document/s to be Released</button>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-requests" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>My Requested Documents</h4>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                              <th width="10%">Request Code</th>
                              <th width="20%">Documents</th>
                              <th width="10%">Date Submitted</th>
                              <th width="5%">Receipt Info</th>
                              <th width="20%">Status</th>
                              <th width="35%">Action</th>
                          </thead>
                          <tbody>
                            <?php if (!empty($requests)): ?>
                              <?php foreach ($requests as $request): ?>
                                <tr>
                                  <td><?= esc($request['slug']) ?></td>
                                  <td>
                                    <ul>
                                      <?php
                                      $ctr = 0;
                                      $ctrDocument = 0
                                      ?>
                                      <?php foreach ($request_documents as $request_document): ?>
                                        <?php if (esc($request_document['request_id']) == esc($request['id'])): ?>
                                          <?php $ctrDocument++; ?>
                                          <li  class="text-<?=$request_document['status'] == 'c' ?'success':'danger'?>"><?=esc($request_document['document'])?>
                                          </li>
                                          <?php
                                          if (esc($request_document['status']) == 'r') {
                                            $ctr++;
                                          } ?>
                                        <?php endif; ?>
                                      <?php endforeach; ?>
                                    </ul>
                                  </td>
                                  <td><?=date('F d, Y - h:i A', strtotime(esc($request['created_at'])))?></td>
                                  <td>
                                    <?php if ($request['receipt_number'] == null): ?>
                                      N/A
                                    <?php else: ?>
                                      <a href="#" onClick="viewReceipt('<?=esc($request['receipt_img'])?>', '<?=esc($request['receipt_number'])?>')">View</a>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($request['status'] == 'p'): ?>
                                        Waiting for admin approval
                                    <?php elseif($request['status'] == 'y'): ?>
                                        Waiting for payment (Upload receipt details)
                                    <?php elseif($request['status'] == 'i'): ?>
                                        Admin is checking the receipt details you uploaded
                                    <?php else: ?>
                                        Your requests is now on process
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                    <?php if ($request['status'] == 'p'): ?>
                                      <a href="#" onclick="deleteRequest(<?=esc($request['id'])?>)" class="btn btn-danger btn-sm">Cancel Request</a>
                                    <?php elseif($request['status'] == 'y'): ?>
                                      <a href="#" onclick="uploadReceipt(<?=esc($request['id'])?>)" class="btn btn-secondary btn-sm">Upload Receipt</a>
                                      <a target="_blank" href="<?=base_url()?>/requests/stub/<?=esc($request['id'])?>" class="btn btn-success btn-sm">Download Stub</a>
                                    <?php elseif($request['status'] == 'i'): ?>
                                      <a href="#" onclick="uploadReceipt(<?=esc($request['id'])?>)" class="btn btn-secondary btn-sm">Reupload Receipt</a>
                                      <a target="_blank" href="<?=base_url()?>/requests/stub/<?=esc($request['id'])?>" class="btn btn-success btn-sm">Download Stub</a>
                                    <?php else: ?>
                                      <a target="_blank" href="<?=base_url()?>/requests/stub/<?=esc($request['id'])?>" class="btn btn-success btn-sm">Download Stub</a>
                                    <?php endif; ?>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                              <?php else: ?>
                                <td colspan="6" class="text-center">You don't have active request</td>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-approval" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Office Approval</h4>
                      <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Document</th>
                                <th>Office</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Date Requested</th>
                            </thead>
                            <tbody>
                            <?php if (empty($office_approvals)): ?>
                              <tr>
                                <td colspan="6" class="text-center">You have no on process document request</td>
                              </tr>
                            <?php else: ?>
                              <?php foreach ($office_approvals as $office_approval): ?>
                                <tr>
                                  <td><?= esc($office_approval['document']) ?></td>
                                  <td><?= esc($office_approval['office']) ?></td>
                                  <td><?= esc($office_approval['status']) == 'p' ? 'Pending for Approval': 'On Hold'?></td>
                                  <td><?= esc(!empty($office_approval['remark'])) ? esc($office_approval['remark']) : 'N/A' ?></td>
                                  <td><?= date('F d, Y - h:i A', strtotime(esc($office_approval['created_at'])))?></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-process" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>On Process Documents (To Be Printed)</h4>
                      <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Document</th>
                                <th>Date Requested</th>
                                <th>Remark</th>
                            </thead>
                            <tbody>
                            <?php if (empty($request_details_process)): ?>
                              <tr>
                                <td colspan="3" class="text-center">You have no on process document request</td>
                              </tr>
                            <?php else: ?>
                              <?php foreach ($request_details_process as $request_detail): ?>
                                <tr>
                                  <td><?= esc($request_detail['document']) ?></td>
                                  <td><?= date('F d, Y - h:i A', strtotime(esc($request_detail['created_at'])))?></td>
                                  <td><?= esc(empty($request_detail['remark']) ? 'N/A': esc($request_detail['remark'])) ?></td>
                                </tr>
                              <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-released" role="tabpanel" aria-labelledby="nav-contact-tab">
                  <div class="row">
                    <div class="col-md-12">
                      <h4>Documents For Claiming</h4>
                      <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Document</th>
                                <th>Date Finished</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                            <?php if (empty($request_details_ready)): ?>
                              <tr>
                                <td colspan="3" class="text-center">You have no to be release document request</td>
                              </tr>
                            <?php else: ?>
                              <?php foreach ($request_details_ready as $request_detail): ?>
                                <tr>
                                  <td><?= esc($request_detail['document']) ?></td>
                                  <td><?= date('F d, Y - h:i A', strtotime(esc($request_detail['updated_at'])))?></td>
                                  <td>₱ <?= (esc($request_detail['price']) * esc($request_detail['quantity'])) * esc($request_detail['page'])?></td>
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
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
          <div class="row">
            <div class="col-md-12">
              <span class="text-muted">
                <strong>REMINDER:</strong>
                <p>
                  <ul class="fst-italic">
                    <li>Requesting of documents should be made during office hours. (Weekdays from 8:00 AM - 5:00 PM only)</li>
                    <li>Make sure that your information and requests are correct before submitting.</li>
                    <li>You may still cancel your requested document if your application is not been approved by the Registrar.</li>
                    <li>Once a request has been submitted, you will be unable to request another document until your requested document is complete.</li>
                  </ul>
                </p>
              </span>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
