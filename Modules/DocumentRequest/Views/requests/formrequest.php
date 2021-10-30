
<div class="container" id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form 137 Requests Forms</li>
                  </ol>
                </nav>
                <hr>
                <h4>Request Form 137 Form</h4>
                <form class="" action="form-137" method="post">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="school" class="form-label">School: </label>
                        <input type="text" name="school" class="form-control" id="school" placeholder="School Name" value="">
                        <?php if (isset($error['school'])): ?>
                          <div class="text-danger">
                            <?=$error['school']?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="address" class="form-label">School Adress: </label>
                        <input type="text" name="address" class="form-control" id="address" placeholder='School Address' value="">
                        <?php if (isset($error['address'])): ?>
                          <div class="text-danger">
                            <?=$error['address']?>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label for="sy_admission" class="form-label">School Year Admission: </label>
                        <input type="text" name="sy_admission" class="form-control" id="sy_admission" placeholder='2018-2019' value="">
                        <div class="text-danger">
                          <?php if (isset($error['sy_admission'])): ?>
                            <?=$error['sy_admission']?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="remarks" id="inlineRadio1" value="1" checked>
                        <label class="form-check-label" for="inlineRadio1">1st Request</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="remarks" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2">2nd Request</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="remarks" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3">3rd Request</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="remarks" id="inlineRadio4" value="4">
                        <label class="form-check-label" for="inlineRadio4">4th Request</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary float-end" name="button">Submit</button>
                    </div>
                  </div>
                </form>
                <hr>
                <!-- <h2>Request History</h2> -->
                <div class="table-responsive">
                  <table class="table table-striped history">
                    <thead>
                        <th>Date Requested</th>
                        <th>School</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                      <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                          <tr>
                            <td><?= esc(esc($request['created_at'])) ?></td>
                            <td><?= esc(esc($request['school'])) ?></td>
                            <td><?=esc($request['status'])?></td>
                            <td><?= esc($request['remarks']) ?></td>
                            <td>
                              <?php if ($request['status'] == 'o'): ?>
                                <a href="form-137/<?=esc($request['id'])?>" target="_blank"> Download Here </a>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                          <td colspan="5" class="text-center">You don't have active request</td>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
