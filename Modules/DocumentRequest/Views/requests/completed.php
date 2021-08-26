<section class="content">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboards"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request History</li>
                      </ol>
                    </nav>
                    <hr>
                    <!-- <h2>Request History</h2> -->
                    <div class="table-responsive">
                      <table class="table table-striped dataTable">
                        <thead>
                            <th>Name</th>
                            <th>Document Requested</th>
                            <th>Reason</th>
                            <th>Date Requested</th>
                            <th>Date Completed</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                          <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $request): ?>
                              <tr>
                                <td style="text-transform: uppercase;"><?= ucwords(esc($request['firstname']) . ' ' . esc($request['lastname']) . ' ' . esc($request['suffix'])) ?></td>
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
                                <td><?= esc($request['reason']) ?></td>
                                <td><?=date('F d, Y - h:i A', strtotime(esc($request['created_at'])))?></td>
                                <td><?=date('F d, Y - h:i A', strtotime(esc($request['completed_at'])))?></td>
                                <td>
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#history<?=esc($request['id'])?>">
                                    View
                                  </button>
                                  <div class="modal fade" id="history<?=esc($request['id'])?>" tabindex="-1" aria-labelledby="history<?=esc($request['id'])?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Request - <?=esc(ucwords($request['slug']))?></h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <table>
                                            <tr>
                                              <th>Requestor:</th>
                                              <td><?=ucwords(esc($request['firstname']) . ' '. esc($request['lastname']))?></td>
                                            </tr>
                                            <tr>
                                              <th>Reason:</th>
                                              <td><?=esc($request['reason'])?></td>
                                            </tr>
                                            <tr>
                                              <th>Date Approved:</th>
                                              <td><?=date('M d, Y', strtotime(esc($request['approved_at'])))?></td>
                                              <th>Date Completed:</th>
                                              <td><?=date('M d, Y', strtotime(esc($request['completed_at'])))?></td>
                                            </tr>
                                          </table>
                                          <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                              <tr>
                                                <th width="1%">#</th>
                                                <th width="14%">Document Requested</th>
                                                <th width="50%">General Clearance</th>
                                                <th width="15%">Date Printed</th>
                                                <th width="15%">Date Claimed</th>
                                                <th width="5%">Price</th>
                                              </tr>
                                              <?php $ctr = 1 ?>
                                              <?php foreach ($request_documents as $request_document): ?>
                                                <?php if (esc($request_document['request_id']) == esc($request['id'])): ?>
                                                  <tr>
                                                    <td><?=esc($ctr)?></td>
                                                    <td><?=esc($request_document['document'])?></td>
                                                    <td>
                                                      <table class="table" width="100%" border="0" align="center">
                                                      <?php $approval_ctr = 0; ?>
                                                      <?php foreach ($office_approvals as $office_approval): ?>
                                                        <?php if ($office_approval['request_detail_id'] == $request_document['id']): ?>
                                                          <?php if ($approval_ctr++ == 0): ?>
                                                              <tr>
                                                                <th>Office</th>
                                                                <th>Approve Date</th>
                                                                <th>Hold Date</th>
                                                                <th>Hold Remark</th>
                                                              </tr>
                                                          <?php endif; ?>
                                                          <tr>
                                                            <td><?=ucwords(esc($office_approval['office']))?></td>
                                                            <td><?=date('M d, Y', strtotime(esc($office_approval['approved_at'])))?></td>
                                                            <td><?=$office_approval['hold_at'] == null ? 'N/A': date('M d, Y', strtotime(esc($office_approval['hold_at'])))?></td>
                                                            <td><?=$office_approval['remark'] == null ? 'N/A' :ucwords(esc($office_approval['remark']))?></td>
                                                          </tr>
                                                          <?php $approval_ctr++; ?>
                                                        <?php endif; ?>

                                                      <?php endforeach; ?>
                                                      </table>
                                                      <?php if ($approval_ctr++ == 0): ?>
                                                        This document don't require a clearance
                                                      <?php endif; ?>
                                                    </td>
                                                    <td><?=date('M d, Y', strtotime(esc($request_document['printed_at'])))?></td>
                                                    <td><?=date('M d, Y', strtotime(esc($request_document['received_at'])))?></td>
                                                    <td>
                                                      <?php if ($request_document['page'] == null): ?>
                                                        <?=esc($request_document['price'] * $request_document['quantity'])?>
                                                      <?php else: ?>
                                                        <?=esc(($request_document['price'] * $request_document['page']) * $request_document['quantity'])?>
                                                      <?php endif; ?>
                                                    </td>
                                                  </tr>
                                                  <?php $ctr++; ?>
                                                <?php endif; ?>
                                              <?php endforeach; ?>
                                            </table>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </td>
                              </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                              <td colspan="4" class="text-center">You don't have active request</td>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>