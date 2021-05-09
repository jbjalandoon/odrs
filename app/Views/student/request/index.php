<div class="container" id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
                      <li class="breadcrumb-item active" aria-current="page">My Requests</li>
                    </ol>
                  </nav>
                  <hr>
                    <div class="row">
                        <!-- <div class="col-md-3">
                            <table class="table request">
                                <thead>
                                    <th><i class="fas fa-bullhorn"></i>ADVISORY TO ALL USERS</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span>Announcement regarding the availability of Registrar/Cashier</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                        <div class="col-md-3">
                            <table class="table request">
                                <!-- <thead>
                                    <th><i class="fas fa-file-alt"></i>REQUEST YOUR ACADEMIC DOCUMENTS ONLINE</th>
                                </thead> -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="student/request" class="btn" disabl><i class="fas fa-plus"></i> Request document here</a>
                                            <br><br><br>
                                            <span>Request for a copy of your academic related documents.</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    
                    <!-- <div class="row"> -->
                        <div class="col-md-9">
                            <div class="tab">
                                <button class="tablinks" onclick="opentab(event, 'myRequest')" id="defaultOpen">My Requests</button>
                                <button class="tablinks" onclick="opentab(event, 'onProcess')">On Process Document/s</button>
                                <button class="tablinks" onclick="opentab(event, 'tobeRelease')">Document/s to be Released</button>
                            </div>
                
                            <div id="myRequest" class="tabcontent">
                                <h3>My Requested Documents</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <th>Document</th>
                                        <th>Date Requested</th>
                                        <th>Action</th>
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
                              
                              <div id="onProcess" class="tabcontent">
                                <h3>On Process Documents</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <th>Document</th>
                                        <th>Date Requested</th>
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
                              
                              <div id="tobeRelease" class="tabcontent">
                                <h3>Documents For Claiming</h3>
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


