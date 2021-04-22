<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <div class="col-12">
          <span class="h2">My Request</span>
          <a href="student/request" class="btn btn-primary float-end" disabl>Request Document</a>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <table class="table mt-3">
            <thead>
              <tr>
                <!-- <th>Unique Identifier</th> -->
                <th>Documents</th>
                <th>Date Requested</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($requests)): ?>
                <?php foreach ($requests as $request): ?>
                  <tr>
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
                              <?php
                                if ($request_document['status'] == 'r') {
                                  echo "( Ready to release )";
                                } else if ($request_document['status'] == 'c') {
                                  echo " ( Received )";
                                } else {
                                  echo " ( On Process )";
                                }
                               ?>
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
                      <?php if ($request['status'] == 'p'): ?>
                        <a href="<?=base_url()?>/student/request/delete/<?=esc($request['id'])?>" class="btn btn-danger btn-sm">Cancel Request</a>
                      <?php else: ?>
                        <a target="_blank" href="<?=base_url()?>/student/stub/<?=esc($request['id'])?>" class="btn btn-success btn-sm">Download Stub</a>
                      <?php endif; ?>
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
      <div class="row">
        <div class="col-12 mt-3">
          <span class="h3">Ready to release document/s</span>
          <table class="table table-bordered mt-4">
            <thead>
              <tr>
                <th scope="col">Document</th>
                <th scope="col">Date Finished</th>
                <th scope="col">Price</th>
              </tr>
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
      <hr>
      <div class="row">
        <div class="col-12 mt-3">
          <span class="h3">On process document/s</span>
          <table class="table table-bordered table-responsive mt-4">
            <thead>
              <tr>
                <th>Document</th>
                <th>Date Requested</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($request_details_process)): ?>
                <tr>
                  <td colspan="2" class="text-center">You have no on process document request</td>
                </tr>
              <?php else: ?>
                <?php foreach ($request_details_process as $request_detail): ?>
                  <tr>
                    <td><?= esc($request_detail['document']) ?></td>
                    <td><?= date('F d, Y - h:i A', strtotime(esc($request_detail['created_at'])))?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>
