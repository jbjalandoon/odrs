    <section class="content">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-12 mb-3">
              <span class="h2">Claimed Request</span>
              <button class="float-end btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Generate Report
              </button>
            </div>
          </div>
          <div class="row mb-3">
            <div class="collapse" id="collapseExample">
              <div class="card">
                <div class="card-body">
                  <form  action="claimed-requests/report" method="get">
                    <div class="row mb-3">
                      <div class="col-4">
                        <label for="document" class="form-label">Document</label>
                        <select id="document" class="form-select" name="d">
                          <?php if (!empty($documents)): ?>
                            <?php foreach ($documents as $document): ?>
                              <option value="<?=esc($document['id'])?>"><?=ucwords(esc($document['document']))?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <div class="col-4">
                        <label  for="type" class="form-label">Type</label>
                        <select id="type" class="form-select" name="t">
                          <option value="yearly">Yearly</option>
                          <option value="monthly">Monthy</option>
                          <option value="daily">Daily</option>
                        </select>
                      </div>
                      <div class="col-4">
                        <label for="argument" class="form-label"> # </label>
                        <input type="year" id="argument" class="form-control" name="a" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <button type="submit" class="float-end btn btn-secondary" formtarget="_blank"> Generate </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="input-group mb-3">
                <label class="input-group-text" for="document">Filter by Documents: </label>
                <select class="form-select" id="documents" onchange="filterClaimeds()">
                  <?php if (empty($documents)): ?>
                    <option value="" disabled selected>--No Documents Found--</option>
                  <?php else: ?>
                    <option value="0" selected>All</option>
                    <?php foreach($documents as $document): ?>
                      <option value="<?=esc($document['id'])?>"><?=esc(ucwords($document['document']))?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive" id="claimedRequest">
                <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Document</th>
                      <th>Reason</th>
                      <th>Date Requested</th>
                      <th>Date Printed</th>
                      <th>Proess Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($request_details as $request_detail): ?>
                      <tr>
                        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']) . ' ' . esc($request_detail['suffix']))?></td>
                        <td><?=ucwords(esc($request_detail['abbreviation']))?></td>
                        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['document']))?></td>
                        <td style="text-transform: uppercase;"><?=ucwords(esc($request_detail['reason']))?></td>
                        <td><?=date('M d, y - H:i A', strtotime(esc($request_detail['confirmed_at'])))?></td>
                        <td><?=date('M d, y - H:i A', strtotime(esc($request_detail['printed_at'])))?></td>
                        <td>
                          <?php $date1 = strtotime(esc($request_detail['confirmed_at'])) ?>
                          <?php $date2 = strtotime(esc($request_detail['printed_at'])) ?>
                          <?php
                            $diff = abs($date2 - $date1);
                            $years = floor($diff / (365*60*60*24));
                            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                            $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
                            $seconds = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
                          ?>
                          <?php printf("%d days, %d hours, ". "%d minutes",$days, $hours, $minutes)?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
