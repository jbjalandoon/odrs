<div class="container" id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request History</li>
                  </ol>
                </nav>
                <hr>
                <!-- <h2>Request History</h2> -->
                    <table class="table table-striped history">
                        <thead>
                            <th>Code</th>
                            <th>Document Requested</th>
                            <th>Reason</th>
                            <th>Date Requested</th>
                            <th>Date Completed</th>
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
                                <td><?= esc($request['reason']) ?></td>
                                <td><?=date('F d, Y - h:i A', strtotime(esc($request['created_at'])))?></td>
                                <td><?=date('F d, Y - h:i A', strtotime(esc($request['completed_at'])))?></td>
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
