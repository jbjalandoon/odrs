<section>
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
              <i class="fas fa-users"></i> Users
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-recycle-tab" data-bs-toggle="pill" data-bs-target="#pills-recycle" type="button" role="tab" aria-controls="pills-recycle" aria-selected="false">
              <i class="fas fa-archive"></i> Recycle Bin
            </button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <!-- CONTENTS -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card">
              <div class="card-body">
                <div class="container-fluid p-1">
                  <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <?=esc($_SESSION['success_message'])?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <small class="text-muted">User Management</small>
                      <h2>Users</h2>
                    </div>
                    <div class="col-md-6">
                      <?=esc(buttons($allPermissions, ['add-users'], 'users'))?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th width="5%">#</th>
                              <th width="15%">Name</th>
                              <th width="15%">Role</th>
                              <th width="15%">Email</th>
                              <th width="10%">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($users)): ?>
                              <?php foreach ($users as $user): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($user['firstname']) . ' ' . $user['lastname'])?></td>
                                  <td><?=ucfirst(esc($user['role']))?></td>
                                  <td><?=ucfirst(esc($user['email']))?></td>
                                  <td class="text-center">
                                    <?=esc(buttons($allPermissions, ['edit-users','delete-users'], 'users', $user['user_id']))?>
                                  </td>
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
          <!-- **************** Recycle Bin *************** -->
          <div class="tab-pane fade" id="pills-recycle" role="tabpanel" aria-labelledby="pills-recycle-tab">
            <div class="card">
              <div class="card-body">
                <div class="container-fluid p-1">
                  <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <?=esc($_SESSION['success_message'])?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <div class="col-md-12">
                      <small class="text-muted">User Management | Users</small>
                      <h2>Recylcle Bin</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Role</th>
                              <th>Email</th>
                              <th>Date Deleted</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($users_deleted)): ?>
                              <?php foreach ($users_deleted as $user): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($user['firstname']) . ' ' . $user['lastname'])?></td>
                                  <td><?=ucfirst(esc($user['role']))?></td>
                                  <td><?=ucfirst(esc($user['email']))?></td>
                                  <td>Date</td>
                                  <td class="text-center">
                                    <?=esc(buttons($allPermissions, ['restore-all'], 'users', $user['user_id']))?>
                                  </td>
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
    </div>
  </div>
</section>
